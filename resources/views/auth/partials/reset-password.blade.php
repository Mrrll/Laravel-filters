@extends('layouts.plantilla')
@section('title', trans('Reset Password'))
@section('content')
    <main class="container-fluid align-self-center">
        <div class="grid align-items-center justify-self-center" style="--bs-columns: 3; --bs-gap: 1rem;">
            <div class="g-col-12 g-col-md-1 g-start-md-2">
                <x-auth.singin.partials.reset.card token="{{ $token }}" email="{{ $email }}" />
            </div>
        </div>
    </main>
    <x-auth.singup.modal />
    <x-auth.singin.modal />
@endsection
