@extends('adminlte::page')

@section('title', 'Detalhes da Permissão {{ $permission->name }}')

@section('content_header')
<h1>Detalhes da Permissão {{ $permission->name }}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        @include('admin.includes.alerts')
        <ul>
            <li>
                <strong>Nome:</strong> {{ $permission->name }}
            </li>
            <li>
                <strong>Descrição:</strong> {{ $permission->description }}
            </li>
        </ul>
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Deletar a Permissão {{ $permission->name }}</button>
        </form>
    </div>
</div>
@stop