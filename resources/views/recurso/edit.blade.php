@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url ('/recurso/'. $recurso->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field ('PATCH')}}
@include('recurso.form',['modo'=>'Editar'])

</form>
</div>
@endsection