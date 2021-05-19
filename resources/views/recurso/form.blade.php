<h1>{{$modo}} Recurso</h1>

@if(count($errors)>0)

 <div class="alert alert-danger" role="alert">
 <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
 </ul>
 </div>
    
@endif

<div class="form-group">

<label for="nombre_recurso">Nombre</label>
    <input type="text" class="form-control" name="nombre_recurso"
    value="{{ isset($recurso->nombre_recurso)? $recurso->nombre_recurso:old('nombre_recurso') }}" id="nombre_recurso">
    </div>

    <div class="form-group">
    <label for="detalles_recurso">Detalles</label>
    <input type="text" class="form-control" name="detalles_recurso"
    value="{{isset( $recurso->detalles_recurso)?$recurso->detalles_recurso:old('detalles_recurso') }}" id="detalles_recurso">    
    </div>
<div class="form-group">

<div class="form-row">
    <div class="form-group col-md-3">
    <label for="estatus_recurso">Estatus</label>
    <input type="text" class="form-control" name="estatus_recurso"
    value="@isset ($recurso->estatus_recurso) @if($recurso->estatus_recurso == 1) Disponible @else No disponible @endif @endisset" id="estatus_recurso">
    </div>
    <div class="form-group col-md-3">
    <label for="cantidad_recurso">Cantidad disponible</label>
    <input type="text" class="form-control" name="cantidad_recurso"
    value="{{ isset($recurso->cantidad_recurso)? $recurso->cantidad_recurso:old('cantidad_recurso') }}" id="cantidad_recurso">
    </div>
    <div class="form-group col-md-3">
    <label for="costo_recurso">Costo</label>
    <input type="text" class="form-control" name="cantidad_recurso"
    value="{{ isset($recurso->costo_recurso)? $recurso->costo_recurso:old('costo_recurso') }}" id="costo_recurso">
    </div>
    <div class="form-group col-md-3">
    <label for="fecha_registro">Fecha de registro</label>
      <input type="date" class="form-control" name="fecha_registro"
    value="{{ isset($recurso->fecha_registro)?$recurso->fecha_registro:old('fecha_registro') }}" id="fecha_registro">
    </div>
  </div>

    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">

    
<a class="btn btn-light" href="{{url ('recurso/')}}">Regresar</a>