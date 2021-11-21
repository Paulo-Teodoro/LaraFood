@extends('adminlte::page')

@section('title', 'Categorias do produto {{ $product->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index') }}">Perfis</a></li>
</ol>

<h1>Categorias do produto {{ $product->name }} <a href="{{ route('products.categories.available', $product->id) }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('products.categories.detach', [$product->id, $category->id]) }}" class="btn btn-danger">Desvincular</a>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $categories->appends($filters)->links() !!}      
            @else
                {!! $categories->links() !!}
            @endif
            
        </div>
    </div>
@stop

