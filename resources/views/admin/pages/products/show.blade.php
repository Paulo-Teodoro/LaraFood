@extends('adminlte::page')

@section('title', 'Detalhes do Produto {{ $product->title }}')

@section('content_header')
<h1>Detalhes do Produto <b>{{ $product->title }}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        @include('admin.includes.alerts')
        <ul>
            <li>
                    <img src="{{ url("storage/{$product->image}") }}" alt="" style="max-width:90px;" />
            </li>
            <li>
                <strong>Título:</strong> {{ $product->title }}
            </li>
            <li>
                <strong>Flag:</strong> {{ $product->flag }}
            </li>
            <li>
                <strong>Descrição:</strong> {{ $product->description }}
            </li>
        </ul>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Deletar o Produto {{ $product->name }}</button>
        </form>
    </div>
</div>
@stop