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
    


<a href="{{url ('docente/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nuevo docente</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Foto</th>
            <th scope="row">Nombre</th>
            <th scope="row">Apellidos</th>
            <th scope="row">Correo</th>
            <th scope="row">Carrera</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($docentes as $docente)
        <tr>
            <td>{{ $docente->id }}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$docente->foto_docente }}" width="50" alt=""></td>
            <td>{{ $docente->nombre_docente }}</td>
            <td>{{ $docente->apellidos_docente }}</td>
            <td>{{ $docente->correo_docente }}</td>
            <td>{{ $docente->siglas_carrera }}</td>
            <td>
            
            <a href="{{ url ('/docente/'.$docente->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/docente/'.$docente->id) }}" class="d-inline" method="post">
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