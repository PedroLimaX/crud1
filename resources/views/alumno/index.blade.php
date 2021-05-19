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
    


<a href="{{url ('alumno/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nuevo alumno</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Foto</th>
            <th scope="row">Nombre</th>
            <th scope="row">Apellidos</th>
            <th scope="row">Correo</th>
            <th scope="row">Telefono</th>
            <th scope="row">Carrera</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($alumnos as $alumno)
        <tr>
            <td>{{ $alumno->id }}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$alumno->foto_alumno }}" width="50" alt=""></td>
            <td>{{ $alumno->nombre_alumno }}</td>
            <td>{{ $alumno->apellidos_alumno }}</td>
            <td>{{ $alumno->correo_alumno }}</td>
            <td>{{ $alumno->telefono_alumno }}</td>
            <td>{{ $alumno->siglas_carrera }}</td>
            <td>
            
            <a href="{{ url ('/alumno/'.$alumno->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/alumno/'.$alumno->id) }}" class="d-inline" method="post">
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