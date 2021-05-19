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
    


<a href="{{url ('empresa/create')}}" class="btn btn-outline-light" style="background-color: #ED7102">Registrar nueva empresa</a>
<br><br>
<table class="table table-hover">
    <thead style="background: #00B5E2; color:white">
        <tr>
            <th scope="row" >#</th>
            <th scope="row">Foto</th>
            <th scope="row">Nombre</th>
            <th scope="row">Correo</th>
            <th scope="row">Telefono</th>
            <th scope="row">Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->id }}</td>
            <td><img class="img-thumbnail img-fluid" src="{{asset ('storage').'/'.$empresa->foto_empresa }}" width="50" alt=""></td>
            <td>{{ $empresa->nombre_empresa }}</td>
            <td>{{ $empresa->correo_empresa }}</td>
            <td>{{ $empresa->telefono_empresa }}</td>
            <td>
            
            <a href="{{ url ('/empresa/'.$empresa->id.'/edit') }}"class="btn btn-primary" >
                Editar
            </a>
            | 
            
            <form action="{{ url ('/empresa/'.$empresa->id) }}" class="d-inline" method="post">
            @csrf
            {{ method_field('DELETE') }}

            <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el registro?')" value="Borrar">

            </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!!$empresas->links()!!}
</div>
@endsection