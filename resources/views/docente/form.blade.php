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
        <h1>{{$modo}} Docente</h1>
        </div>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nombre_docente">Nombre</label>
          <input type="text" class="form-control" name="nombre_docente"
          value="{{ isset($docente->nombre_docente)? $docente->nombre_docente:old('nombre_docente') }}" id="nombre_docente">
        </div>
        <div class="form-group col-md-6">
        <label for="apellidos_docente">Apellidos</label>
    <input type="text" class="form-control" name="apellidos_docente"
    value="{{isset( $docente->apellidos_docente)?$docente->apellidos_docente:old('apellidos_docente') }}" id="apellidos_docente">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
        <label for="correo_docente">Correo</label>
        <input type="text" class="form-control" name="correo_docente"
        value="{{ isset($docente->correo_docente)?$docente->correo_docente:old('correo_docente') }}" id="correo_docente">
        </div>
        <div class="form-group col-md-6">
          <label for="telefono_docente">Telefono</label>
          <input type="text" class="form-control" name="telefono_docente"
          value="{{ isset($docente->telefono_docente)?$docente->telefono_docente:old('telefono_docente') }}" id="telefono_docente">
        </div>
      </div>
      
    </div>
    <div class="form-group col-md-3">
    <label for="foto_docente"></label>
    @if(isset($docente->foto_docente))
    <img class="img-thumbnail img-fluid mx-auto d-block" src="{{asset ('storage').'/'.$docente->foto_docente }}" width="200" alt="">
    @endif
    <input type="file" class="form-control-file" name="foto_docente" value="" id="foto_docente">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      @isset($carreras)
        <label for="carrera_id">Carrera</label>
        <div class="form-group">
          <select class="form-control" id="carrera_id">
            @foreach($carreras as $carrera)
              <option name="carrera_id" id="carrera_id" value="{{$carrera->id}}"
                @if($docente->carrera_id==$carrera->id) selected @endif>
                {{ $carrera->nombre_carrera }}
              </option>
            @endforeach
          </select>
        </div>
      @endisset
    </div>
  </div>

  <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">
  <a class="btn btn-light" href="{{url ('docente/')}}">Regresar</a>