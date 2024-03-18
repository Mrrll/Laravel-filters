<x-dom.modal id="singup" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Sing Up')
    </x-slot:title>
    <x-auth.singup.form/>
    <x-slot:footer>
        <x-dom.form id="form_register" :action="route('register')" method="POST">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing Up')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
@if ($errors->register->any())
    <script type="module">
        $('#singup').modal('show');
        $("#singin").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#singin").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
