@csrf
@include('admin.includes.alerts')

<div class="form-group">
    <label>Identificação:</label>
    <input type="text" name="identify" class="form-control" value="{{ $table->identify ?? old('identify') }}" placeholder="Identificação:">
</div>

<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="5" value="{{ $table->description ?? old('description') }}" class="form-control">{{ $table->description ?? old('description') }}</textarea>
</div>
  
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>