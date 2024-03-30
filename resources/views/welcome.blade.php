@extends('layouts.plantilla')

@section('title', 'Welcome')

@section('content')
    <main class="container-fluid align-self-center">
        <div class="grid align-items-center align-self-center" style="--bs-gap: 1rem;">
            @forelse ($movies as $movie)
                <div class="g-col-12 g-col-md-4 g-col-lg-2">
                    <x-app.movies.card :movie="$movie" />
                </div>
            @empty
                <div class="g-col-12">
                    <h4>There are no movies</h4>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $movies->links() }}
        </div>
        <x-auth.singup.modal />
        <x-auth.singin.modal />
    </main>
@endsection
