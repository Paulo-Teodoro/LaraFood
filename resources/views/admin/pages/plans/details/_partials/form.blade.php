@include('admin.includes.alerts')
@csrf

<div class="form-group">
    <label for="">Nome:</label>
    <input type="text" name="name" placeholder="Nome" value="{{ $detail->name ?? old('name') }}" class="form-control">
</div>

<div class="form-group">
   <button type="submit" class="btn btn-info">Enviar</button>
</div>