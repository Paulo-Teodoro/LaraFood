<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use TenantTrait;

    protected $fillable = ['title','flag', 'price', 'description', 'image'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function search($filter = null) {
        $results = $this
                    ->where('title', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->latest()
                    ->paginate();

        return $results;            
    }

    /**
     * Categories not linked with this product
     */

    public function categoriesAvailable($filter = null)
    {
        //SELECT * FROM categories WHERE id NOT IN (SELECT category_id FROM category_product WHERE product_id={$this->id})  
        $categories = Category::whereNotIn('categories.id', function($query) {
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter) {
            if($filter)
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $categories;                
    }
}
