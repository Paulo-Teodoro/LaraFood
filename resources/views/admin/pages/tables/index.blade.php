@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('tables.index') }}">Mesas</a></li>
</ol>

<h1>Mesas <a href="{{ route('tables.create') }}" class="btn btn-success">ADD <i class="fas fa-plus-square"></i></a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tables.search') }}" method="post" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Identificação" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-info">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Identificação</th>
                        <th>Ações</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach ($tables as $table)
                        <tr>
                            <td>{{ $table->identify }}</td>
                            <td>
                                <a href="{{ route('tables.show', $table->id) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-warning">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tables->appends($filters)->links() !!}      
            @else
                {!! $tables->links() !!}
            @endif
            
        </div>
    </div>
@stop

