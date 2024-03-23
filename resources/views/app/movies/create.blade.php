@extends('layouts.plantilla')

@section('title', 'Create Movie')

@section('content')
        <main class="container-fluid align-self-center">
        <div class="grid align-items-center" style="--bs-columns: 3; --bs-gap: 1rem;">
            <div class="g-col-3 g-col-lg-1 g-start-lg-2">
                <x-app.movies.card />
            </div>
        </div>
    </main>
@endsection
