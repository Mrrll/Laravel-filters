<div class="grid align-items-center" style="--bs-columns: 12; --bs-gap: 0rem;">
    <div class="g-col-2">
        <div class="d-flex justify-content-center">

            @if (auth()->user()->profile->first() && auth()->user()->profile->first()->image->first())
                <img height="48px" width="48px"
                    src="{{ route('private', ['file' => auth()->user()->profile->first()->image->first()->fileName]) }}">
            @else
                <x-svg.avatar color="#000000" height="48px" width="48px" />
            @endif
        </div>

        <span class="ms-1 me-1 d-flex justify-content-center text-wrap">
            <small>
                {{ auth()->user()->name }}
            </small>
        </span>

    </div>
    <div class="g-col-10">
        <label for="">@lang('Comment')</label>
        <x-dom.form action="{{ route('comments.store') }}" method="POST">
            <x-dom.input type="hidden" name="movie_id" value="{{ $movie->id }}" />
            <div class="input-group mb-3">
                <input type="text" name="message" class="form-control" placeholder="@lang('Write your comement')"
                    value="{{ old('message') }}">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">
                    <i class="fa-regular fa-paper-plane fa-lg"></i>
                </button>
            </div>
        </x-dom.form>
    </div>
</div>
