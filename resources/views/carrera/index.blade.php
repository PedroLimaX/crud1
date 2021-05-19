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
    


<a href="{{url ('carrera/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nueva carrera</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Nombre</th>
            <th scope="row">Siglas</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($carreras as $carrera)
        <tr>
            <td>{{ $carrera->id }}</td>
            <td>{{ $carrera->nombre_carrera }}</td>
            <td>{{ $carrera->siglas_carrera }}</td>
            <td>
            
            <a href="{{ url ('/carrera/'.$carrera->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/carrera/'.$carrera->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">

            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!!$carreras->links()!!}
</div>
@endsection