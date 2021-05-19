@extends('layouts.app')

@section('content')
<div class="container">
<form  action="{{ url('/recurso') }}" method="post" enctype="multipart/form-data">
@csrf
@include('recurso.form',['modo'=>'Crear'])
</form>
</div>
@endsection