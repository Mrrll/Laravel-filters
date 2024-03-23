<x-dom.modal id="gender" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Create gender')
    </x-slot:title>
    <x-app.gender.form />
</x-dom.modal>
@if ($errors->gender->any())
    <script type="module">
        $('#gender').modal('show');
    </script>
@endif
