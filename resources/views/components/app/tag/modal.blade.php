<x-dom.modal id="tag" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Create tag')
    </x-slot:title>
    <x-app.tag.form />
</x-dom.modal>
@if ($errors->tag->any())
    <script type="module">
        $('#tag').modal('show');
        $("#profile").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#profile").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
        $("#gender").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#gender").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
