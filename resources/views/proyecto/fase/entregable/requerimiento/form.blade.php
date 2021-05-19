<h1>{{$modo}} Requerimiento</h1>

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

<label for="nombre_requerimiento">Nombre</label>
    <input type="text" class="form-control" name="nombre_requerimiento"
    value="{{ isset($requerimiento->nombre_requerimiento)? $requerimiento->nombre_requerimiento:old('nombre_requerimiento') }}" id="nombre_requerimiento">

    </div>
    
    <div class="form-group">
    <label for="exampleFormControlTextarea1">Detalles</label>
    <textarea class="form-control" aria-label="With textarea" name="observaciones" rows="10" id="observaciones">
    {{ isset($requerimiento->detalles_requerimiento)?$requerimiento->detalles_requerimiento:old('detalles_requerimiento') }}
      </textarea>
    </div>
    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">
    
    <a class="btn btn-light" href="{{URL::previous()}}">Regresar</a>