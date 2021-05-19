<h1>{{$modo}} Fase</h1>

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

<label for="nombre_fase">Nombre</label>
    <input type="text" class="form-control" name="nombre_fase"
    value="{{ isset($fase->nombre_fase)? $fase->nombre_fase:old('nombre_fase') }}" id="nombre_fase">

    </div>

    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fecha_inicio">Fecha de inicio</label>
      <input type="date" class="form-control" name="fecha_inicio"
    value="{{ isset($fase->fecha_inicio)?$fase->fecha_inicio:old('fecha_inicio') }}" id="fecha_inicio">
    </div>
    <div class="form-group col-md-6">
      <label for="fecha_final">Fecha de final</label>
      <input type="date" class="form-control" name="fecha_final"
    value="{{ isset($fase->fecha_final)?$fase->fecha_final:old('fecha_final') }}" id="fecha_final">
    </div>
  </div>    
  <div class="form-group">
    <div class="form-group">
      @isset($entregables)
        <label for="nombre_equipo">Entregables</label>
        <div class="card-deck">
          @foreach($entregables as $entregable)
            <div class="card text-center" style="width: 18rem; align:center;  border-color: #003B5C;">
              <div class="card-header text-white" style="background-color: #003B5C">
                <h5 class="card-title">{{ $entregable->nombre_entregable }}</h5>
              </div>
              <div class="card-body">
                <p class="card-text">Fecha Limite: {{ $entregable->fecha_limite }}</p>
                <p class="card-text">Fecha de entrega: {{ $entregable->fecha_entrega }}</p>
                <p class="card-text">Completado: 
                  @if ( $entregable->completo_entregable > 0)
                    Si
                  @else No
                  @endif
                </p>
                <a href="{{ url ('/proyecto/fase/entregable/'.$entregable->id.'/edit') }}"
                  class="btn text-white" style="background-color: #00B5E2" >Ver</a>
                <form action="{{ url ('/proyecto/fase/entregable/'.$entregable->id) }}" class="d-inline" method="post">
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
    <a href="{{url ('proyecto/fase/entregable/create')}}" class="btn text-white float-right" style="background-color: #ED7102" style="background-color: #ED7102">
      Registrar nuevo entregable
    </a>
  @endif
  <input class="btn btn-primary" type="submit" value="{{$modo}} Datos">  
  <a class="btn btn-light" href="{{URL::previous()}}">Regresar</a>
