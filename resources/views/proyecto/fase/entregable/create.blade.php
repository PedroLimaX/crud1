@extends('layouts.app')

@section('content')
<div class="container">
<form  action="{{ url('/proyecto/fase/entregable') }}" method="post" enctype="multipart/form-data">
@csrf
@include('proyecto/fase/entregable.form',['modo'=>'Crear'])
</form>
</div>
@endsection