<aside id="aside" class="d-none bg-body-tertiary">
    <div class="d-flex justify-content-between p-3">
        <div class="input-group">
            <span class="input-group-text text-primary">
                <i class="fa-solid fa-filter fa-xl"></i>
            </span>
            <x-dom.input id="search_filters" name="search_filters" type="text" placeholder="Searcher" class="filter" />
        </div>
        <x-dom.button class="btn-close m-auto ms-2" route="showFilter()" />
    </div>

    <div class="list-group list-group-flush">
        <li id="info_links" class="list-group-item list-group-item-action text-center">
            @isset($movies)
                Movies {{ $movies->count() ?? '' }} of {{ $movies->total() ?? '' }}
            @endisset
        </li>
    </div>
    <x-layouts.partials.collapse-gender :genders="isset($genders) ? $genders : null" />
    <x-layouts.partials.collapse-tags :tags="isset($tags) ? $tags : null" />
    <x-layouts.partials.collapse-stars />
</aside>
