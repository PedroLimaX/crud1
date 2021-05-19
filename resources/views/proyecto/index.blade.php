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
    


<a href="{{url ('proyecto/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nuevo proyecto</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Nombre</th>
            <th scope="row">Fecha de inicio</th>
            <th scope="row">Fecha de Final</th>
            <th scope="row">Administrador</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->nombre_proyecto }}</td>
            <td>{{ $proyecto->fecha_inicio }}</td>
            <td>{{ $proyecto->fecha_final }}</td>
            <td>{{ $proyecto->nombre_admin}}</td>
            <td>
            
            <a href="{{ url ('/proyecto/'.$proyecto->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            
            <form action="{{ url ('/proyecto/'.$proyecto->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">

            </form>
            
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection