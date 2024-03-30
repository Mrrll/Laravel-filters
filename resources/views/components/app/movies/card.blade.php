<div id="{{ $movie->id }}" class="card" style="height:350.884px">
    @if ($movie->image->first())
        <div class="card-img-top card-image"
            style="background:url('{{ asset('storage/' . $movie->image->first()->url) }}')">
            <div class="d-flex justify-content-end">
                @can('update', $movie)
                    <a class="btn btn-outline-warning" href="{{ route('movies.edit', $movie) }}">
                        <i class="fa-solid fa-pencil fa-xl"></i>
                    </a>
                @endcan
                @can('delete', $movie)
                    <x-dom.form action="{{ route('movies.destroy', $movie) }}" method="DELETE" valid="{{ false }}">
                        <x-dom.button type="submit" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash fa-xl"></i>
                        </x-dom.button>
                    </x-dom.form>
                @endcan
            </div>
        </div>
    @else
        <div class="card-img-top card-image">
            <div class="d-flex justify-content-end">
                @can('update', $movie)
                    <a class="btn btn-outline-warning" href="{{ route('movies.edit', $movie) }}">
                        <i class="fa-solid fa-pencil fa-xl"></i>
                    </a>
                @endcan
                @can('delete', $movie)
                    <x-dom.form action="{{ route('movies.destroy', $movie) }}" method="DELETE" valid="{{ false }}">
                        <x-dom.button type="submit" class="btn btn-outline-danger">
                            <i class="fa-solid fa-trash fa-xl"></i>
                        </x-dom.button>
                    </x-dom.form>
                @endcan
            </div>
        </div>
    @endif
    <div class="card-body d-flex flex-column pt-0 ">
        <small class="card-title text-wrap" style="height: 63px">
            <strong>
                {{ $movie->title }}
            </strong>
            <small class="card-text text-end text-muted">
                {{ $movie->year->format('Y') }}
            </small>
        </small>

        <small class="card-text text-center">
            @if ($movie->ratings->first() != null)
                <x-app.ratings.stars :rating="$movie->ratings->first()->rating" />
            @else
                <x-app.ratings.stars />
            @endif
        </small>
        <p class="card-text text-truncate">
            {{ $movie->description }}
        </p>

    </div>
    @auth
        <div class="card-footer d-flex justify-content-between">
            <div class="d-flex">
                <x-dom.button type="button" class="btn-sm" route="likeUp('{{ $movie->id }}')">
                    <x-svg.thumbs-up color="#041ae0" height="18px" width="18px" />
                </x-dom.button>
                <x-dom.button type="button" class="btn-sm" route="likeDown('{{ $movie->id }}')">
                    <x-svg.thumbs-down color="#e00404" height="18px" width="18px" />
                </x-dom.button>
            </div>
            <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-info btn-sm">
                @lang('See more...')
            </a>
        </div>
    @endauth
</div>
