@props(['profile' => null])

<x-dom.modal id="profile" :centered="true" class="modal-fullscreen-md-down">
    <x-slot:title>
        @lang('Profile')
    </x-slot:title>
    <x-app.profile.form :profile="isset($profile) && $profile ? $profile : null" />
    <x-slot:footer>
        <x-dom.form id="form_profile" :action="isset($profile) && $profile ? route('profile.update', $profile) : route('profile.store')" method="{{ isset($profile) && $profile ? 'PATCH' : 'POST' }}">
            <x-dom.button type="submit" class="btn-primary disabled">
                @lang('Save')
            </x-dom.button>
        </x-dom.form>
    </x-slot:footer>
</x-dom.modal>
@if ($errors->profile->any())
    <script type="module">
        $('#profile').modal('show');
    </script>
@endif
