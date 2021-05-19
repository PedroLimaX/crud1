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
          <h1>{{$modo}} Alumno</h1>
        </div>
      </div>
      
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nombre_alumno">Nombre</label>
          <input type="text" class="form-control" name="nombre_alumno"
            value="{{ isset($alumno->nombre_alumno)? $alumno->nombre_alumno:old('nombre_alumno') }}" id="nombre_alumno">
        </div>

        <div class="form-group col-md-6">
          <label for="apellidos_alumno">Apellidos</label>
          <input type="text" class="form-control" name="apellidos_alumno"
            value="{{isset( $alumno->apellidos_alumno)?$alumno->apellidos_alumno:old('apellidos_alumno') }}" id="apellidos_alumno">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="correo_alumno">Correo</label>
          <input type="text" class="form-control" name="correo_alumno"
            value="{{ isset($alumno->correo_alumno)?$alumno->correo_alumno:old('correo_alumno') }}" id="correo_alumno">
        </div>

        <div class="form-group col-md-6">
          <label for="telefono_alumno">Telefono</label>
          <input type="text" class="form-control" name="telefono_alumno"
            value="{{ isset($alumno->telefono_alumno)?$alumno->telefono_alumno:old('telefono_alumno') }}" id="telefono_alumno">
        </div>
      </div>
    </div>
    <div class="form-group col-md-3" >
    <label for="foto_alumno"></label>
      @if(isset($alumno->foto_alumno))
        <img class="img-thumbnail img-fluid mx-auto d-block " src="{{asset ('storage').'/'.$alumno->foto_alumno }}" width="200" alt="">
      @endif
      <input type="file" class="form-control-file" name="foto_alumno" value="" id="foto_alumno" >
    </div>
  @if($modo == 'Crear')
    <div class="form-group">
    <select  class="form-control" name="carrera_id" id="carrera_id">
    @foreach($carreras as $carrera)
      <option name="carrera_id" id="carrera_id" value="{{$carrera->id}}">
        {{ $carrera->nombre_carrera }}
      </option>
    @endforeach
    </select>
    </div>
  @else
  <div class="form-row">
    <div class="form-group col-md-12">
      @isset($carreras)
        <label for="carrera_id">Carrera</label>
        <div class="form-group">
          <select class="form-control" id="carrera_id">
            @foreach($carreras as $carrera)
              <option name="carrera_id" id="carrera_id" value="{{$carrera->id}}"
                @if($alumno->carrera_id==$carrera->id) selected @endif>
                {{ $carrera->nombre_carrera }}
              </option>
            @endforeach
          </select>
        </div>
      @endisset
  @endif

    <div class="form-group col-md-12">
      @isset($equipos)
        <label for="nombre_equipo">Equipos</label>
        <div class="card-group ">
          @foreach($equipos as $equipo)
            <div class="card text-dark text-center" style="width: 18rem; align:center; border-color: #003B5C;">
              <div class="card-header text-white" style="background-color: #003B5C">
                <h5 class="card-title">{{ $equipo->nombre_equipo }}</h5>
              </div>
              <br>
              <img class="img-thumbnail img-fluid mx-auto" src="{{asset ('storage').'/'.$equipo->foto_equipo }}" width="50%"  alt=""></td>
              <div class="card-body">
                <p class="card-text">{{ $equipo->eslogan_equipo }}</p>
                <a href="#" class="btn text-white" style="background-color: #00B5E2">Remover</a>
              </div>
            </div>
          @endforeach
        </div>
      @endisset
    </div>
  </div>
  
  <input class="btn btn-primary" type="submit" value="{{$modo}} Datos" style="background-color: #003B5C">  
  <a class="btn btn-light" href="{{url ('alumno/')}}">Regresar</a>