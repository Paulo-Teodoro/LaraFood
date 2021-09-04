@extends('adminlte::page')

@section('title', 'Planos do perfil {{ $profile->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('profiles.index') }}">Perfis</a></li>
</ol>

<h1>Perfis do perfil {{ $profile->name }} <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->name }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>
                                <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('plans.profile.detach', [$plan->id, $profile->id]) }}" class="btn btn-danger">Desvincular</a>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}      
            @else
                {!! $plans->links() !!}
            @endif
            
        </div>
    </div>
@stop

