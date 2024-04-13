@extends('layouts.plantilla')

@section('title', 'Welcome')

@section('content')
    <main class="container-fluid">
        <div class="d-flex align-content-center justify-content-end mt-2">
            <x-dom.search />
        </div>
        <div class="content-movies">
            <x-app.movies.movies :movies="$movies" />
        </div>
        <x-auth.singup.modal />
        <x-auth.singin.modal />
    </main>
@endsection
