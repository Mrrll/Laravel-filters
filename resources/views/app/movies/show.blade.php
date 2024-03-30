@extends('layouts.plantilla')

@section('title', 'Show Movie')

@section('content')
    <main class="container-fluid ">
        <div class="d-flex justify-content-between mt-2">
            <h4>Show Movie</h4>
            <x-dom.button class="btn btn-secondary" type="link" route="movies.index">
                @lang('Back')
            </x-dom.button>
        </div>
        <div class="grid mt-2" style="--bs-rows: 1; --bs-columns: 3;--bs-gap: 1rem;">

            <div class="g-col-3 g-col-lg-1 show-image rounded  shadow-sm"
                style="background:url('{{ asset('storage/' . $movie->image->first()->url) }}');height:70vh;">
            </div>


            <div class="g-col-3 g-col-lg-1 rounded  border border-1 shadow-sm p-2" style="height:70vh;">
                <div class="grid align-items-center" style="--bs-gap: 0.3rem;">
                    <div class="g-col-12 g-col-lg-6">
                        <h4>
                            <strong>
                                {{ $movie->title ?? '' }}
                            </strong>
                        </h4>
                    </div>
                    <div class="g-col-12 g-col-lg-6">
                        @lang('Year of movie') :
                        <strong>{{ $movie->year->format('Y') ?? '' }}</strong>
                    </div>
                    <div class="g-col-12 g-col-lg-6">
                        <h5>
                            <strong>{{ $movie->gender->name ?? '' }}</strong>
                        </h5>
                    </div>
                    <div class="g-col-12 g-col-lg-6 overflow-auto" style="max-height: 180px">
                        <p>{{ $movie->description ?? '' }}</p>
                    </div>
                    <div class="g-col-12 g-col-lg-6 overflow-auto mt-1" style="max-height: 75px;">
                        @foreach ($movie->tags as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                        @endforeach

                    </div>
                </div>
            </div>



            <div class="g-col-3 g-col-lg-1 rounded border border-1 shadow-sm p-2" style="height:70vh;">
                <x-app.comments.form :movie="$movie" />
                <div class="grid align-items-center overflow-auto" style="--bs-gap: 1rem; max-height:310px">
                    <div class="g-col-12">
                        @forelse ($movie->comments as $comment)
                            <hr class="g-col-12">
                            <div class="grid align-items-center comment" style="--bs-columns: 12; --bs-gap: 0rem;">
                                <div class="g-col-2">
                                    <div class="d-flex justify-content-center">
                                        @if ($comment->user->profile->first() && $comment->user->profile->first()->image->first())
                                            <img height="48px" width="48px"
                                                src="{{ route('private', ['file' => $comment->user->profile->first()->image->first()->fileName]) }}">
                                        @else
                                            <x-svg.avatar color="#000000" height="48px" width="48px" />
                                        @endif
                                    </div>

                                    <span class="ms-1 me-1 d-flex justify-content-center text-wrap">
                                        <small>
                                            {{ $comment->user->name }}
                                        </small>
                                    </span>
                                </div>
                                <div class="g-col-10">
                                    <p>
                                        {{ $comment->message }}
                                    </p>
                                </div>
                                @can('delete', $comment)
                                    <x-dom.form action="{{ route('comments.destroy', $comment) }}" method="DELETE"
                                        valid="{{ false }}">
                                        <x-dom.button type="submit" class="btn-delete-comment">
                                            <i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i>
                                        </x-dom.button>
                                    </x-dom.form>
                                @endcan

                            </div>

                        @empty
                            <p>@lang('There are no comments')</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
