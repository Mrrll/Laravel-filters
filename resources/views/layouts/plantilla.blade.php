<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body class="body">
    <x-layouts.header :profile="isset($profile) && $profile ? $profile : null" />
    <x-layouts.aside :genders="isset($genders) && $genders ? $genders : null" :tags="isset($tags) && $tags ? $tags : null" :totalmovies="isset($totalMovies) ? $totalMovies : null" :movies="isset($movies) ? $movies : null" />
    @include('messages.toasts')
    @yield('content')
    <x-layouts.footer />
    @auth
        <x-app.profile.modal :profile="isset($profile) && $profile ? $profile : null" />
    @endauth
    @can('isAdmin')
        <x-app.gender.modal :gender="isset($gender) && $gender ? $gender : null" />
        <x-app.tag.modal :tag="isset($tag) && $tag ? $tag : null" />
    @endcan
</body>

</html>
