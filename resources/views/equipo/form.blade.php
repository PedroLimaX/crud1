@if(count($errors)>0)

 <div class="alert alert-danger" role="alert">
 <ul>
    @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
 </ul>
 </div>
    
@endif



<form>
  <div class="form-row">
    <div class="form-group col-md-8">
    <div class="form-row">
        <div class="form-group col-md-10">
        <h1>{{$modo}} Equipo</h1>
        </div>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
        <label for="nombre_equipo">Nombre</label>
        <input type="text" class="form-control" name="nombre_equipo"
        value="{{ isset($equipo->nombre_equipo)? $equipo->nombre_equipo:old('nombre_equipo') }}" id="nombre_equipo">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-12">
        <label for="eslogan_equipo">Slogan</label>
        <input type="text" class="form-control" name="eslogan_equipo"
        value="{{isset( $equipo->eslogan_equipo)?$equipo->eslogan_equipo:old('eslogan_equipo') }}" id="eslogan_equipo">
        </div>
      </div>
    </div>
    
    <div class="form-group col-md-3">
    <label for="foto_alumno"></label>
    @if(isset($equipo->foto_equipo))
    <img class="img-thumbnail img-fluid mx-auto d-block" src="{{asset ('storage').'/'.$equipo->foto_equipo }}" width="200" alt="">
    @endif
    <input type="file" class="form-control-file" name="foto_equipo" value="" id="foto_equipo">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      @isset($alumnos)
        <label for="nombre_equipo">Integrantes</label>
        <div class="card-deck">  
          @foreach($alumnos as $alumno)
            <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
              <div class="card-header text-white" style="background-color: #003B5C">
                <h5 class="card-title">{{ $alumno->nombre_alumno }} {{ $alumno->apellidos_alumno }}</h5>
              </div>
              <img class="img-thumbnail img-fluid mx-auto" src="{{asset ('storage').'/'.$alumno->foto_alumno }}" width="50%"  alt=""></td>
              <div class="card-body">
                <p class="card-text">{{ $alumno->siglas_carrera }}</p>
                <a href="#" class="btn btn-light text-white" style="background-color: #ED7102">@if($alumno->estatus == 1) Desactivar @else Activar @endif</a>
              </div>
              <div class="card-footer text-white" style="background-color: #00B5E2">
                <small class="text-white">Estado Actual: @if($alumno->estatus == 1) Activo @else Inactivo @endif</small>
              </div>
            </div>
          @endforeach
        </div>
      @endisset
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      @isset($alumnos)
        <label for="nombre_equipo">Proyecto</label>
        <div class="card-deck">
          @foreach($proyectos as $proyecto)
            <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
              <div class="card-header text-white" style="background-color: #003B5C">
                <h5 class="card-title">{{ $proyecto->nombre_proyecto }}</h5>
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $proyecto->nombre_proyecto }}</h5>
                <p class="card-text">{{ $proyecto->descripcion_proyecto }}</p>
                <a href="#" class="btn btn-primary">Remover</a>
              </div>
            </div>
          @endforeach
        </div>
      @endisset
    </div>
  </div>
    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">
    
<a class="btn btn-light" href="{{url ('equipo/')}}">Regresar</a>