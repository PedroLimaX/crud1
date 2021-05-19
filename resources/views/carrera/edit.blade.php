@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url ('/carrera/'. $carrera->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field ('PATCH')}}
@include('carrera.form',['modo'=>'Editar'])

</form>
</div>
@endsection