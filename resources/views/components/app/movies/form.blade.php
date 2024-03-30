<div class="grid" style="--bs-gap: 1rem;">
    <div class="g-col-12 g-col-lg-6">
        <x-dom.input label="Title" type="text" name="title" form="form_movie" :value="old('title', isset($movie) ? $movie->title : '')" />
    </div>
    <div class="g-col-12 g-col-lg-6">
        <div class="d-flex justify-content-between">
            <label for="">@lang('Select to Gender')</label>
            @error('gender_id')
                <small id="message_errors" class="text-danger">*{{ $message }}</small>
            @enderror
        </div>
        <x-app.gender.partials.select :genders="$genders" form="form_movie" :select="isset($movie) ? $movie->gender_id : ''" />
    </div>
    <div class="g-col-12 g-col-lg-6">
        <x-dom.input rows="5" label="Description" type="textarea" name="description" form="form_movie"
            class="resize-none">
            {{ isset($movie) ? trim($movie->description) : '' }}
        </x-dom.input>
    </div>

    <div class="g-col-12 g-col-lg-6">
        <x-app.tag.partials.select :tags="$tags" form="form_movie" :select="isset($movie) ? $movie->id : ''" />
    </div>
</div>
