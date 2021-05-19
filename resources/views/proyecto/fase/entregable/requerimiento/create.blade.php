@extends('layouts.app')
@section('content')
<div class="container">
<form  action="{{ url('/proyecto/fase/entregable/requerimiento') }}" method="post" enctype="multipart/form-data">
@csrf
@include('proyecto/fase/entregable/requerimiento.form',['modo'=>'Crear'])
</form>
</div>
@endsection