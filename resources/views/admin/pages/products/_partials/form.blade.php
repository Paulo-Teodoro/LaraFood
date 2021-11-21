@csrf
@include('admin.includes.alerts')

<div class="form-group">
    <label>Título:</label>
    <input type="text" name="title" class="form-control" value="{{ $product->title ?? old('title') }}" placeholder="Título:">
</div>

<div class="form-group">
    <label>Preço:</label>
    <input type="text" name="price" class="form-control" value="{{ $product->price ?? old('price') }}" placeholder="Preço:">
</div>

<div class="form-group">
    <label>Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="5" value="{{ $product->description ?? old('description') }}" class="form-control">{{ $product->description ?? old('description') }}</textarea>
</div>
  
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>