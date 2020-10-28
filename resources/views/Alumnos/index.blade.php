@extends('layouts.app')

@section('content')

<div class="container">
@if(Session::has('Mensaje')){{
    Session::get('Mensaje')
}}
@endif


<a href="{{url('Alumnos/create')}}" class="btn btn-success ">Agregar Alumno</a>
</br>
</br>

<table class="table table-ligth table-hover">

</div>

<thread class="thead-light">

    <tr>
        <th> ID</th>
        <th> Nombre </th>
        <th> Programa Académico </th>
        <th> Boleta </th>
        <th> Teléfono Móvil </th>
        <th> Teléfono Fijo </th>
        <th> Teléfono Personal </th>
        <th> Correo </th>
        <th> NSS </th>

    </tr>
</thread>

</tbody>
@foreach($Alumnos as $alumno)
    <tr>
        <td>{{$loop->iteration}} </td>
        <td>{{$alumno->Nombre}} {{$alumno->ApellidoP}} {{$alumno->ApellidoM}}</td>
        <td>{{$alumno->ProgramaAcademico}}</td>
        <td>{{$alumno->Boleta}}</td>
        <td>{{$alumno->TelefonoMovil}}</td>
        <td>{{$alumno->TelefonoFijo}}</td>
        <td>{{$alumno->TelefonoPersonal}}</td>
        <td>{{$alumno->Correo}}</td>
        <td>{{$alumno->NSS}}</td>
        <td>

        <a class="btn btn-primary" href="{{url('/Alumnos/'.$alumno->id.'/edit')}}" style="display:inline">
        Editar
        </a> 
 
        <form method="post" action="{{url('Alumnos/'.$alumno->id)}}" style="display:inline" >
       {{csrf_field()}}
       {{method_field('DELETE')}}
       <button class="btn btn-success" type="submit" onclick="return confirm (¿Deseas Eliminar?);">Borrar</button>
       </form>
         </td>

    </tr>
  @endforeach
  </tbody>
</table>

@endsection