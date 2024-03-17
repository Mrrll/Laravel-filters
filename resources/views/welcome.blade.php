@extends('layouts.plantilla')

@section('title', 'Welcome')

@section('content')
    <main class="container-fluid ">
        <h1>Welcome</h1>
        <x-auth.singup.partials.modal />
        <x-auth.singin.partials.modal />
    </main>
@endsection
