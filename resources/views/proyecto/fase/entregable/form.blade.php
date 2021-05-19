<h1>{{$modo}} Entregable</h1>

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

<label for="nombre_entregable">Nombre</label>
    <input type="text" class="form-control" name="nombre_entregable"
    value="{{ isset($entregable->nombre_entregable)? $entregable->nombre_entregable:old('nombre_entregable') }}" id="nombre_entregable">

    </div>
    


    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fecha_limite">Fecha Limite</label>
      <input type="date" class="form-control" name="fecha_limite"
    value="{{ isset($entregable->fecha_limite)?$entregable->fecha_limite:old('fecha_limite') }}" id="fecha_limite">
    </div>
    <div class="form-group col-md-6">
      <label for="fecha_entrega">Fecha de entrega</label>
      <input type="date" class="form-control" name="fecha_entrega"
    value="{{ isset($entregable->fecha_entrega)?$entregable->fecha_entrega:old('fecha_entrega') }}" id="fecha_entrega">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      @isset($docentes)
        <label for="carrera_id">Docente que revisa</label>
        <div class="form-group">
          <select class="form-control" id="carrera_id">
            @foreach($docentes as $docente)
              <option name="carrera_id" id="carrera_id" value="{{$docente->id}}"
                @if($entregable->docente_id==$docente->id) selected @endif>
                {{ $docente->nombre_docente }} {{ $docente->apellidos_docente }}
              </option>
            @endforeach
          </select>
        </div>
      @endisset
    </div>
    <div class="form-group col-md-6">
    <label for="completo_entregable">Completado</label>
    <input type="text" class="form-control" name="completo_entregable"
    value="@isset ($entregable->completo_entregable) @if($entregable->completo_entregable == 1) Si @else No @endif @endisset" id="completo_entregable" >
    
    </div>
  </div>

  
    <div class="form-group">
      <div class="form-group">  
        @isset($requerimientos)
          <label for="nombre_equipo">Requerimientos</label>
          <div class="card-deck">
            @foreach($requerimientos as $requerimiento)
              <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
                <div class="card-header text-white" style="background-color: #003B5C">
                  <h5 class="card-title">{{ $requerimiento->nombre_requerimiento }}</h5>
                </div>
                <div class="card-body">
                  <p class="card-text">{{ $requerimiento->detalles_requerimiento }}</p>
                  <a href="{{ url ('/proyecto/fase/entregable/requerimiento/'.$requerimiento->id.'/edit') }}"
                    class="btn text-white" style="background-color: #00B5E2" >Ver</a>
                  <form action="{{ url ('/proyecto/fase/entregable/requerimiento/'.$requerimiento->id) }}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        @endisset
      </div>
    </div>
    @if($modo == 'Editar')
    <a href="{{url ('proyecto/fase/entregable/requerimiento/create')}}" class="btn text-white float-right" style="background-color: #ED7102" style="background-color: #ED7102">
      Registrar nuevo requerimiento
    </a>
    @endif
    <br>

    <div class="form-group">
    <label for="evidencia_entregable">Plantilla</label>
    @if(isset($entregable->plantilla_entregable))
    <img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$entregable->plantilla_entregable }}" width="70" alt="">
    @endif
    <input type="file" class="form-control-file" name="plantilla_entregable" value="" id="plantilla_entregable">
   
    </div>

    <div class="form-group">
    <label for="evidencia_entregable">Archivo de evidencia</label>
    @if(isset($entregable->archivo_entrega))
    <img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$entregable->archivo_entrega }}" width="70" alt="">
    @endif
    <input type="file" class="form-control-file" name="archivo_entrega" value="" id="archivo_entrega">
   
    </div>


    <div class="form-group">
    <label for="exampleFormControlTextarea1">Comentarios</label>
    <textarea class="form-control" aria-label="With textarea" name="observaciones" rows="10" id="observaciones">{{ isset($entregable->observaciones)?$entregable->observaciones:old('observaciones') }}
      </textarea>
    </div>
    <div class="form-group">
    
  </div>
    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">
    


    
    <a class="btn btn-light" href="{{URL::previous()}}">Regresar</a>