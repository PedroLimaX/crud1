<h1>{{$modo}} Carrera</h1>

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

<label for="nombre_carrera">Nombre</label>
    <input type="text" class="form-control" name="nombre_carrera"
    value="{{ isset($carrera->nombre_carrera)? $carrera->nombre_carrera:old('nombre_carrera') }}" id="nombre_carrera">

    </div>
    <div class="form-group">
    <label for="siglas_carrera">Siglas</label>
    <input type="text" class="form-control" name="siglas_carrera"
    value="{{isset( $carrera->siglas_carrera)?$carrera->siglas_carrera:old('siglas_carrera') }}" id="siglas_carrera">    
    </div>

    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">

    
<a class="btn btn-light" href="{{url ('carrera/')}}">Regresar</a>