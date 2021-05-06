<div class="container md-6">
  <fieldset>

    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input type="text" class="form-control" name="nombre" id="nombre" required value="{{isset($datos->nombre)? $datos->nombre: ''}}">
    </div>

    <div class="form-group">
      <label for="categoria">Categoria</label>
      <input type="text" class="form-control" name="categoria" id="categoria" value="{{isset($datos->categoria)? $datos->categoria: ''}}" required>
    </div>


    <div class="form-group">
      <label for="ingredientes">Ingredientes</label>
      <textarea class="form-control" rows="3" name="ingredientes" id="ingredientes" required>{{isset($datos->ingredientes)? $datos->ingredientes: ''}}</textarea>
    </div>


    <div class="form-group">
      <label for="preparacion">Preparacion</label>
      <textarea class="form-control" rows="3" name="preparacion" id="preparacion" required>{{isset($datos->preparacion)? $datos->preparacion: ''}}</textarea>
    </div>

    <div class="form-group">
      <label for="foto">Subir imagen</label>
      <input type="file" class="form-control-file" type="file" name="foto" id="foto">
    </div>

    @if(isset($datos->foto))
    <img class="w-25 img-fluid img-thumbnail" src="{{asset('storage').'/'.$datos->foto}}">
    @endif

    <input class=" form-control btn btn-success" type="submit" value="{{$modo}} la receta">
  </fieldset>
</div>