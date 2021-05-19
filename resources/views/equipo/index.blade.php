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
    


<a href="{{url ('equipo/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nuevo equipo</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Foto</th>
            <th scope="row">Nombre</th>
            <th scope="row">Slogan</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($equipos as $equipo)
        <tr>
            <td>{{ $equipo->id }}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$equipo->foto_equipo }}" width="50" alt=""></td>
            <td>{{ $equipo->nombre_equipo }}</td>
            <td>{{ $equipo->eslogan_equipo }}</td>
            <td>
            
            <a href="{{ url ('/equipo/'.$equipo->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/equipo/'.$equipo->id) }}" class="d-inline" method="post">
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