@extends('layouts.app')

@section('content')

<div class="container">
@if(Session::has('Mensaje')){{
    Session::get('Mensaje')
}}
@endif

<example-component></example-component>

@endsection