<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.form id="form_tag" :action="route('tags.store')" method="POST">
            <label>@lang('Add Tag')</label>
            <div class="input-group mb-3">
                <x-dom.input name="name" form="form_tag" />
                <x-dom.button class="btn-outline-primary disabled" type="submit">
                    @lang('Add')
                </x-dom.button>
            </div>
        </x-dom.form>
    </div>
</div>
