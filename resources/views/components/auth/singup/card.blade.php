<x-dom.card>
    <x-slot:header>
        <div class="card-header">
            Sing Up
        </div>
    </x-slot:header>
    <x-auth.singup.form />
    <x-slot:footer>
        <div class="card-footer d-flex justify-content-end">
            <x-dom.form id="form_register">
                <x-dom.button type="submit" class="btn-primary disabled">
                    @lang('Sing Up')
                </x-dom.button>
            </x-dom.form>
        </div>
    </x-slot:footer>
</x-dom.card>
