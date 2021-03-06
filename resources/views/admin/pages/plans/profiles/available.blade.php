@extends('adminlte::page')

@section("title", "Perfis disponíveis para o plano {{ $plan->name }}")

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
</ol>

<h1>Perfis disponíveis para o plano {{ $plan->name }} <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('plans.profiles.available', $plan->id) }}" method="post" class="form form-inline">
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
                <form action="{{ route('plans.profiles.attach', $plan->id)}}" method="post">
                        @csrf

                        @foreach ($profiles as $profile)
                            <tr>
                            <td><input type="checkbox" name="profiles[]" value="{{ $profile->id }}"></td>
                                <td>{{ $profile->name }}</td>
                                <td>{{ $profile->description }}</td>
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
                {!! $profiles->appends($filters)->links() !!}      
            @else
                {!! $profiles->links() !!}
            @endif
            
        </div>
    </div>
@stop

