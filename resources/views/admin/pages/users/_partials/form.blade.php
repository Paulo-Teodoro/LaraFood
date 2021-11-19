@csrf
@include('admin.includes.alerts')

<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" value="{{ $user->name ?? old('name') }}" placeholder="Nome:">
</div>

<div class="form-group">
    <label>E-mail:</label>
    <input type="email" name="email" class="form-control" value="{{ $user->email ?? old('email') }}" placeholder="E-mail:">
</div>

<div class="form-group">
    <label>Senha:</label>
    <input type="password" name="password" class="form-control" placeholder="Senha:">
</div>
  
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>