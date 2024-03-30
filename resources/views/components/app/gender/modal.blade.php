<x-dom.modal id="gender" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Create gender')
    </x-slot:title>
    <x-app.gender.form />
</x-dom.modal>
@if ($errors->gender->any())
    <script type="module">
        $('#gender').modal('show');
        $("#profile").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#profile").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
        $("#tag").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#tag").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
