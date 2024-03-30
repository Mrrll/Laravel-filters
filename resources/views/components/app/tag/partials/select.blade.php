<div class="grid" style="--bs-gap: 0.1rem;">
    <div class="g-col-12">
        <label for="">@lang('Select to tags')</label>
        <select id="tags" class="form-select" aria-label="Default select example" onchange="tags(event)">
            <option selected>Open this select menu</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">@lang($tag->name)</option>
            @endforeach
        </select>
    </div>
    <div class="g-col-12">
        <fieldset class="border p-2" id="list_tags" data-movie="{{ $select ?? '' }}">
            <legend class="float-none w-auto p-2 fs-5 m-0">Tags</legend>
            <x-dom.input type="hidden" name="tags" form="{{ $form }}" />
        </fieldset>
    </div>
</div>
