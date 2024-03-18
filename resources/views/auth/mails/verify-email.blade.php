@extends('layouts.plantilla')

@section('title', 'Email verify')

@section('content')
    <main class="container-fluid d-flex align-content-center">
        <div class="grid align-items-center justify-self-center" style="--bs-columns: 3; --bs-gap: 1rem;">
            <div class="g-col-3 g-col-md-1 g-start-md-2">
                <x-messages.alert type="warning" :close="false">
                    <x-slot:title>
                        <h4>@lang('Verify Your Email Address')!</h4>
                    </x-slot:title>
                    <x-dom.form :action="route('verification.send')" method="post" :valid="false">
                        <p><strong>@lang('Verify Email Address')</strong> @lang('Before proceeding, please check your email for a verification link.')</p>
                        <hr>
                        <p class="mb-0">@lang('If you did not receive the email')
                            @lang('click here to request another'),
                            <button class="btn btn-outline-warning"type="submit">@lang('Send new notification for email verification')
                            </button>
                        </p>
                        <strong>@lang('The link will expire in :count minutes.', ['count' => '60'])</strong>
                    </x-dom.form>
                </x-messages.alert>
            </div>
        </div>
    </main>
@endsection
