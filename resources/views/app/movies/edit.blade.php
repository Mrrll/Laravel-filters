@extends('layouts.plantilla')

@section('title', 'Edit Movie')

@section('content')
    <main class="container-fluid ">
        <h3>Edit Movie</h3>
        <div class="grid" style="--bs-gap: 1rem;">
            <div class="g-col-12 g-col-lg-4 border border-2">
                <div class="grid align-items-center" style="--bs-gap: 1rem;">
                    <hr class="g-col-12">
                    <div class="g-col-12 justify-content-center">
                        <x-app.movies.image />
                    </div>
                    <hr class="g-col-12">
                    <div class="g-col-12 p-1">
                        <x-app.movies.form />
                    </div>
                </div>
            </div>
            <div class="g-col-12 g-col-lg-4 border border-2">
                <div class="grid align-items-center" style="--bs-gap: 1rem;">
                    <div class="g-col-12 p-1">
                        <x-app.gender.form />
                    </div>
                </div>
            </div>
            <div class="g-col-12 g-col-lg-4 border border-2 bg-warning">
                <div class="grid align-items-center" style="--bs-gap: 1rem;">

                </div>
            </div>
        </div>
    </main>
@endsection
