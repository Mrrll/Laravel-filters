<x-dom.card>
    <x-slot:header>
        <div class="card-header">
            Sing In
        </div>
    </x-slot:header>
    <x-auth.singin.form />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_login" :action="route('login')" method="POST">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Sing In')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>
<x-auth.singin.partials.forgot.modal :view="true" />
