<h1>{{$modo}} Proyecto</h1>

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

<label for="nombre_proyecto">Nombre</label>
    <input type="text" class="form-control" name="nombre_proyecto"
    value="{{ isset($proyecto->nombre_proyecto)? $proyecto->nombre_proyecto:old('nombre_proyecto') }}" id="nombre_proyecto">

    </div>
    <div class="form-group">
    <label for="descripcion_proyecto">Descripcion</label>
    <input type="text" class="form-control" name="descripcion_proyecto"
    value="{{isset( $proyecto->descripcion_proyecto)?$proyecto->descripcion_proyecto:old('descripcion_proyecto') }}" id="descripcion_proyecto">
    
    </div>
    <div class="form-group">
    <label for="factible_proyecto">Factible</label>
    <input type="text" class="form-control" name="factible_proyecto"
    value="@isset ($proyecto->factible_proyecto) @if($proyecto->factible_proyecto == 1) Si @else No @endif @endisset" id="factible_proyecto">
    
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fecha_inicio">Fecha de inicio</label>
      <input type="date" class="form-control" name="fecha_inicio"
    value="{{ isset($proyecto->fecha_inicio)?$proyecto->fecha_inicio:old('fecha_inicio') }}" id="fecha_inicio">
    </div>
    <div class="form-group col-md-6">
      <label for="inpfecha_finalutPassword4">Fecha de final</label>
      <input type="date" class="form-control" name="fecha_final"
    value="{{ isset($proyecto->fecha_final)?$proyecto->fecha_final:old('fecha_final') }}" id="fecha_final">
    </div>
  </div>

  <div class="form-group">
    <label for="evidencia_entregable">Archivo de evidencia</label>
    @if(isset($proyecto->evidencia_proyecto))
    <img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$proyecto->evidencia_proyecto }}" width="70" alt="">
    @endif
    <input type="file" class="form-control-file" name="archivo_entrega" value="" id="archivo_entrega">
   
    </div>

    <div class="form-group">

  <div class="form-group">
    @isset($admins)
    <label for="admin_id">Administrador Responsable</label>
        <div class="form-group">
          <select class="form-control" id="admin_id">
            @foreach($admins as $admin)
              <option name="admin_id" id="admin_id" value="{{$admin->id}}"
                @if($proyecto->admins_id==$admin->id) selected @endif>
                {{ $admin->nombre_admin }} {{ $admin->apellidos_admin }}
              </option>
            @endforeach
          </select>
        </div>
    @endisset
  </div>
    
    </div>
    @if($modo == 'Editar')
<div class="form-group">
    <label for="progreso_proyecto">Progreso del proyecto</label>
    <h2>
    @foreach($progresos as $progreso)
        {{$progreso->progreso}}
        
    @endforeach%
    (@if( $progreso->progreso == 100) Completado @else No completado @endif)</h2>
    </div>

@endif
    <div class="form-row">
        <div class="form-group col-md-12">
          @isset($fases)
          <label for="nombre_equipo">Fases</label>
          <div class="card-deck">
            @foreach($fases as $fase)
              <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
                <div class="card-header text-white" style="background-color: #003B5C">
                  <h5 class="card-title">{{ $fase->nombre_fase }}</h5>
                </div>
                
                <div class="card-body">
                  <p class="card-text">Fecha de inicio: {{ $fase->fecha_inicio }}</p>
                  <p class="card-text">Fecha de termino: {{ $fase->fecha_final }}</p>
                  <a href="{{ url ('/proyecto/fase/'.$fase->id.'/edit') }}"class="btn btn-primary"
                  class="btn text-white" style="background-color: #00B5E2" >Ver</a>
                  <form action="{{ url ('/proyecto/fase/'.$fase->id) }}" class="d-inline" method="post">
                      @csrf
                      {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        @endisset
      @if($modo == 'Editar')
        <br>
    <a href="{{url ('proyecto/fase/create')}}" class="btn text-white float-right" style="background-color: #ED7102" style="background-color: #ED7102">
      Registrar nueva fase
    </a>
    @endif
        </div>
        
      </div>
    
  

    <div class="form-group">
    @isset($recursos)
          <label for="nombre_equipo">Recursos Necesarios Cantidad  Requerida y Total de Costo</label>
          <ul class="list-group col-md-5">
            @foreach($recursos as $recurso)
            <h5><li class="list-group-item list-group-item-info">{{ $recurso->nombre_recurso }}
              <span class="badge badge-light" style="margin-left: 30px;">  {{ $recurso->cantidad_recurso }}</span>
              <span class="badge badge-light" style="margin-left: 30px;"> $ {{ $recurso->costo_total }} MXN</span>
              
            </li></h5>
            @endforeach
          </ul>
        @endisset
    </div>
    <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">

    
<a class="btn btn-light" href="{{url ('proyecto/')}}">Regresar</a>