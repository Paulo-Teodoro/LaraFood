@extends('adminlte::page')

@section("title", "Permissões disponíveis para o perfil {{ $profile->name }}")

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
</ol>

<h1>Permissões disponíveis para o perfil {{ $profile->name }} <a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('profiles.permissions.available', $profile->id) }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-info">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>    
                </thead>
                <tbody>
                @include('admin.includes.alerts')    
                <form action="{{ route('profiles.permissions.attach', $profile->id)}}" method="post">
                        @csrf

                        @foreach ($permissions as $permission)
                            <tr>
                            <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->description }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="500">
                                <button type="submit" class="btn btn-success">Vincular</button>
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>    
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}      
            @else
                {!! $permissions->links() !!}
            @endif
            
        </div>
    </div>
@stop

