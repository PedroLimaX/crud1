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
        <h1>{{$modo}} Empresa</h1>
        </div>
        
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
        <label for="nombre_empresa">Nombre</label>
    <input type="text" class="form-control" name="nombre_empresa"
    value="{{ isset($empresa->nombre_empresa)? $empresa->nombre_empresa:old('nombre_empresa') }}" id="nombre_empresa">
        </div>
        <div class="form-group col-md-6">
        <label for="gerente_empresa">Gerente</label>
    <input type="text" class="form-control" name="gerente_empresa"
    value="{{isset( $empresa->gerente_empresa)?$empresa->gerente_empresa:old('gerente_empresa') }}" id="gerente_empresa">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
        <label for="correo_empresa">Correo</label>
        <input type="text" class="form-control" name="correo_empresa"
        value="{{ isset($empresa->correo_empresa)?$empresa->correo_empresa:old('correo_empresa') }}" id="correo_empresa">
        </div>
        <div class="form-group col-md-6">
        <label for="telefono_empresa">Telefono</label>
        <input type="text" class="form-control" name="telefono_empresa"
        value="{{ isset($empresa->telefono_empresa)?$empresa->telefono_empresa:old('telefono_empresa') }}" id="telefono_empresa">
        </div>
      </div>
      
    </div>
    <div class="form-group col-md-3">
    <label for="foto_alumno"></label>
    @if(isset($empresa->foto_empresa))
    <img class="img-thumbnail img-fluid mx-auto d-block" src="{{asset ('storage').'/'.$empresa->foto_empresa }}" width="200" alt="">
    @endif
    <input type="file" class="form-control-file" name="foto_empresa" value="" id="foto_empresa">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-12">
      @isset($proyectos)
        <label for="nombre_equipo">Proyecto</label>
        <div class="card-deck">
          @foreach($proyectos as $proyecto)
            <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
              <div class="card-header text-white" style="background-color: #003B5C">
                <h5 class="card-title">{{ $proyecto->nombre_proyecto }}</h5>
              </div>
              <div class="card-body">
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
    
<a class="btn btn-light" href="{{url ('empresa/')}}">Regresar</a>