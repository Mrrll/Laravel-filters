<x-dom.modal id="singin" :centered="true" class="modal-fullscreen-md-down" >
    <x-slot:title>
        @lang('Sing In')
    </x-slot:title>
    <x-auth.singin.form/>
    <x-slot:footer>
        <x-dom.form id="form_login" :action="route('login')" method="POST">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing In')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
<x-auth.singin.partials.forgot.modal />
@if ($errors->login->any())
    <script type="module">
        $('#singin').modal('show');
        $("#singup").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#singup").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
