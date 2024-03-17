<x-dom.modal id="singin" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Sing In')
    </x-slot:title>
    <x-auth.singin.partials.form/>
    <x-slot:footer>
        <x-dom.form id="form_register">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing In')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
