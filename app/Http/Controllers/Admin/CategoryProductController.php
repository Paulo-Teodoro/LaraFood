<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    
    public function categories($idproduct)
    {
        $product = $this->product->find($idproduct);
        if(!$product) {
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();    

        return view('admin.pages.products.categories.index', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function products($idcategory)
    {
        $category = $this->category->find($idcategory);
        if(!$category) {
            return redirect()->back();
        }

        $products = $category->products()->paginate();
        return view('admin.pages.categories.products', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function categoriesAvailable(Request $request, $idproduct)
    {
        if(!$product = $this->product->find($idproduct)){
            dd("erro");
            return redirect()->back(); 
        }
 
        $categories = $product->categoriesAvailable($request->filter);    

        return view('admin.pages.products.categories.available', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function attachCategoriesProduct(Request $request, $idproduct)
    {
        $product = $this->product->find($idproduct);
        if(!$product) {
            return redirect()->back();
        }

        if(!$request->categories || count($request->categories) == 0) {
            return redirect()->back()->with('warning', 'Precisa escolher pelo menos uma categoria');
        }

        $product->categories()->attach($request->categories); 

        return redirect()->route('products.categories', $product->id);
    }

    public function detachCategoriesProduct($idproduct, $idcategory)
    {
        $product = $this->product->find($idproduct);
        $category = $this->category->find($idcategory);

        if(!$product || !$category ){
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }
}
