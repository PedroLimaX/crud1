@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url ('/proyecto/fase/'. $fase->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field ('PATCH')}}

@include('proyecto/fase.form',['modo'=>'Editar'])

</form>
</div>
@endsection