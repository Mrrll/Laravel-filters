<div class="list-group list-group-flush">
    <x-dom.button type="button"
        class="list-group-item list-group-item-action dropdown-toggle border border-top-1 rounded-0 btn-collapse"
        aria-current="true" data-bs-toggle="collapse" data-bs-target="#collapseTags">
        @lang('Tags')
    </x-dom.button>
    <div id="collapseTags" class="collapse list-group list-group-flush">
        <li class="list-group-item list-group-item-action">
            @isset($tags)
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input id="{{ $tag->name }}" class="form-check-input filter" type="checkbox" name="tag"
                            value="{{ $tag->name }}">
                        <label class="form-check-label" for="{{ $tag->name }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
            @endisset
        </li>
    </div>
</div>
