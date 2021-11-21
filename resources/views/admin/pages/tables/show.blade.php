@extends('adminlte::page')

@section('title', 'Detalhes da Mesa {{ $table->name }}')

@section('content_header')
<h1>Detalhes da Mesa <b>{{ $table->name }}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        @include('admin.includes.alerts')
        <ul>
            <li>
                <strong>Nome:</strong> {{ $table->name }}
            </li>
            <li>
                <strong>Url:</strong> {{ $table->url }}
            </li>
            <li>
                <strong>Descrição:</strong> {{ $table->description }}
            </li>
        </ul>
        <form action="{{ route('tables.destroy', $table->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Deletar a Mesa {{ $table->name }}</button>
        </form>
    </div>
</div>
@stop