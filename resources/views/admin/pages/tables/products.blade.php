@extends('adminlte::page')

@section('title', 'Produtos da categoria {{ $category->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Permissões</a></li>
</ol>

<h1>Produtos da categoria {{ $category->name }} <a href="{{ route('categories.index') }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Ações</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                <a href="{{ route('products.categories', $product->id) }}" class="btn btn-warning"><i class="fas fa-lock"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}      
            @else
                {!! $products->links() !!}
            @endif
            
        </div>
    </div>
@stop

