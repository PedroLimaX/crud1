@extends('layouts.app')

@section('content')
<div class="container">
<form  action="{{ url('/proyecto/fase') }}" method="post" enctype="multipart/form-data">
@csrf
@include('proyecto/fase.form',['modo'=>'Crear'])
</form>
</div>
@endsection