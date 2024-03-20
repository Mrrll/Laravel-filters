<x-dom.card>
    <x-slot:header>
        <div class="card-header">
            Reset Password
        </div>
    </x-slot:header>
    <x-auth.singin.partials.reset.form token="{{ $token }}" email="{{ $email }}" />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_reset" action="{{ route('password.update') }}" method="post">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Reset')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>
@if ($errors->reset->any())
    <script type="module">
        $("#singup").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#singin").find('#message_errors').each(function() {
            $(this).hide();
        });
        $("#forgot-password").find('#message_errors').each(function() {
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
        $("#forgot-password").find('input').each(function() {
            $(this).removeClass('is-invalid');
            $(this).val('');
        });
    </script>
@endif
