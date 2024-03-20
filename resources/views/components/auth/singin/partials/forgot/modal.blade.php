<x-dom.modal id="forgot-password" :centered="true" class="modal-fullscreen-md-down" :close="false">
    <x-slot:title>
        @lang('Forgot Password')
    </x-slot:title>
    <x-auth.singin.partials.forgot.form />
    <x-slot:footer>
        @if (isset($view))
            <x-dom.button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                @lang('Back')
            </x-dom.button>
        @else
            <x-dom.button type="modal" class="btn-secondary" route="singin">
                @lang('Back')
            </x-dom.button>
        @endif
        <x-dom.form id="form_forgot" action="{{ route('password.email') }}" method="POST">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Send')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
@if ($errors->forgot->any())
    <script type="module">
        $('#forgot-password').modal('show');
        $("#singup").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#singin").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#singup").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
        $("#singin").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
