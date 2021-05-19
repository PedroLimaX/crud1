@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ url ('/docente/'. $docente->id )}}" method="post" enctype="multipart/form-data">
@csrf
{{method_field ('PATCH')}}
@include('docente.form',['modo'=>'Editar'])

</form>
</div>
@endsection