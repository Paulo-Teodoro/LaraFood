@csrf
@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" value="{{ $category->name ?? old('name') }}" placeholder="Nome:">
</div>

<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="5" value="{{ $category->description ?? old('description') }}" class="form-control">{{ $category->description ?? old('description') }}</textarea>
</div>
  
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>