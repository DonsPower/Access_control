
@extends('layouts.app')

@section('content')

<div class="container">



<form action="{{url('Alumnos/'.$alumno->id)}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
{{method_field('PATCH')}}
@include('Alumnos.form',['Modo'=>'editar'])

</form>
</div>
@endsection