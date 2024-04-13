<div class="d-flex flex-column flex-lg-row justify-content-center align-items-center flex-wrap mt-3">
    @forelse ($movies as $movie)
        <x-app.movies.card :movie="$movie" />
    @empty
        <div>
            <h4>
                @lang('There are no movies')
            </h4>
        </div>
    @endforelse

</div>
<div class="d-flex justify-content-center mt-2">
    {{ $movies->links() }}
    <x-dom.input type="hidden" id="count_links" name="count_links" value="{{ $movies->count() }}" />
    <x-dom.input type="hidden" id="total_links" name="total_links" value="{{ $movies->total() }}" />
    <x-dom.input type="hidden" id="hasMorePages_links" name="hasMorePages_links" value="{{ $movies->hasMorePages() }}" />
    <x-dom.input type="hidden" id="previousPageUrl_links" name="previousPageUrl_links" value="{{ $movies->previousPageUrl() }}" />
</div>
