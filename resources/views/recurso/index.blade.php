@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
    
<div class="alert alert-success alert-dismissable" role="alert">
        {{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    
<a href="{{url ('recurso/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nuevo recurso</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Nombre</th>
            <th scope="row">Estatus</th>
            <th scope="row">Cantidad</th>
            <th scope="row">Disponible desde</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($recursos as $recurso)
        <tr>
            <td>{{ $recurso->id }}</td>
            <td>{{ $recurso->nombre_recurso }}</td>
            <td>@if($recurso->estatus_recurso == 1) Disponible @else No disponible @endif</td>
            <td>{{$recurso->cantidad_recurso}}</td>
            <td>{{$recurso->fecha_registro}}</td>
            <td>
            
            <a href="{{ url ('/recurso/'.$recurso->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/recurso/'.$recurso->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">

            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!!$recursos->links()!!}
</div>
@endsection