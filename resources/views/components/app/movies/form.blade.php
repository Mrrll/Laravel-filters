<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.input label="Title" type="text" name="title" form="form_movie" />
    </div>
    <div class="g-col-12">
        <x-dom.input rows="2" label="Description" type="textarea" name="description" form="form_movie"
            class="resize-none">
        </x-dom.input>
    </div>
    <div class="g-col-12">
        <label for="">@lang('Select to Gender')</label>
        <x-app.gender.partials.select />
    </div>
</div>
