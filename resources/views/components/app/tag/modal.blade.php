<x-dom.modal id="tag" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Create tag')
    </x-slot:title>
    <x-app.tag.form />
</x-dom.modal>
@if ($errors->tag->any())
    <script type="module">
        $('#tag').modal('show');
    </script>
@endif
