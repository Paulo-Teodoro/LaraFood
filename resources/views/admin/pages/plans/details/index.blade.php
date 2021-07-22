@extends('adminlte::page')

@section('title', 'Detalhes do Plano {{ $plan->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->id) }}">Detalhes</a></li>
</ol>

<h1>Detalhes do Plano {{ $plan->name }} <a href="{{ route('details.plan.create', $plan->id) }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @include('admin.includes.alerts')
            
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->name }}</td>
                            <td>
                                <a href="{{ route('details.plan.show', [$plan->id, $detail->id]) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('details.plan.edit', [$plan->id, $detail->id]) }}" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        
    </div>
@stop

