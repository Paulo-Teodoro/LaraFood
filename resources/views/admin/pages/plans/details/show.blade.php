@extends('adminlte::page')

@section('title', 'Detalhes do detalhe {{ $detail->name }}')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->id) }}">{{ $plan->name }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plan.index', $plan->id) }}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plan.edit', [$plan->id, $detail->id]) }}">{{ $detail->name }}}}</a></li>
</ol>

<h1>Detalhes do detalhe {{ $detail->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome:</strong> {{ $detail->name }}
                </li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('details.plan.destroy', [$plan->id, $detail->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o detalhe {{ $detail->name }}</button>
            </form>
        </div>
    </div>            
@stop          