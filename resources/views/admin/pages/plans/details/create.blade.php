@extends('adminlte::page')

@section('title', 'Adicionar novo detalhe ao plano {{ $plan->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->id) }}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.create', $plan->id) }}">Novo</a></li>
</ol>

<h1>Adicionar novo detalhe ao plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('details.plan.store', $plan->id) }}" method="POST">
            @include('admin.pages.plans.details._partials.form')

            </form>
        </div>
    </div>            
@stop            