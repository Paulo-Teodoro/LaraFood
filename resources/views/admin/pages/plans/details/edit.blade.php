@extends('adminlte::page')

@section('title', 'Editar detalhe {{ $detail->name }} do plano {{ $plan->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.index', $plan->id) }}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->id, $detail->id]) }}">Editar</a></li>
</ol>

<h1>Editar detalhe {{ $detail->name }} do plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.update', [$plan->id, $detail->id]) }}" method="POST">
            @method('PUT')    
            @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>            
@stop          