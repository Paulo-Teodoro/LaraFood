@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuario')

@section('content_header')
<h1>Cadastrar Novo Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" class="form" method="POST">
                @include('admin.pages.users._partials.form')
            </form>
        </div>
    </div>
@stop