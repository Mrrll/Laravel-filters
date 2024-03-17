<x-dom.modal id="singup" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Sing Up')
    </x-slot:title>
    <x-auth.singup.partials.form/>
    <x-slot:footer>
        <x-dom.form id="form_register">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Sing Up')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
