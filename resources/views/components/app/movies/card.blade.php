<x-dom.card>
    <x-slot:header>
        <div class="card-header">
           <x-app.movies.image />
        </div>
    </x-slot:header>
    <x-app.movies.form />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_movie" :action="route('movies.store')" method="POST">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Save')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>
