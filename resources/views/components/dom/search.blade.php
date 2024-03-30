<x-dom.form id="form_search" action="#" method="GET" :valid="false">
    <div class="input-group">
        <x-dom.input name="search" type="text" placeholder="Searcher" form="form_search" />
        <x-dom.button type="submit" class="btn btn-outline-primary" form="form_search">
            <i class="fa-solid fa-magnifying-glass fa-xl"></i>
        </x-dom.button>
    </div>
</x-dom.form>
