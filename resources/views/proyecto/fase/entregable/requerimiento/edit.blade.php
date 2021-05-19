@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url ('/proyecto/fase/entregable/requerimiento'. $requerimiento->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field ('PATCH')}}

@include('proyecto/fase/entregable/requerimiento.form',['modo'=>'Editar'])

</form>
</div>
@endsection