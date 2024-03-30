@extends('layouts.plantilla')

@section('title', 'Edit Movie')

@section('content')
    <main class="container-fluid">
        <div class="d-flex justify-content-between mt-2">
            <h4>Edit Movie</h4>
            <x-dom.button class="btn btn-secondary" type="link" route="movies.index">
                @lang('Back')
            </x-dom.button>
        </div>

        <div class="grid align-items-center" style="--bs-gap: 1rem;">
            <x-dom.input type="hidden" name="movie_id" value="{{ $movie->id }}" form="form_movie" />
            <div class="g-col-12 g-col-lg-6">
                <x-app.movies.image :movie="$movie" />
            </div>
            <div class="g-col-12 g-col-lg-6">
                <x-dom.input name="year" form="form_movie" label="Year of movie" :value="old('yea', $movie->year->format('Y'))" />
            </div>
        </div>
        <x-app.movies.form :tags="$tags" :genders="$genders" :movie="$movie" />
        <div class="grid align-items-center text-end" style="--bs-gap: 1rem;">
            <hr class="g-col-12">
            <div class="g-col-12 mb-1">
                <x-dom.form id="form_movie" action="{{ route('movies.update', $movie) }}" method="PATCH">
                    <x-dom.button class="btn-primary disabled" type="submit">
                        @lang('Update')
                    </x-dom.button>
                </x-dom.form>
            </div>
        </div>
    </main>
@endsection
