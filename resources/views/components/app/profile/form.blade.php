@props(['profile'])

<div class="grid align-items-center" style="--bs-gap: 1rem;">
    @if (isset($profile) && $profile)
        <div class="g-col-12">
            <x-dom.input type="hidden" id="profile_id" name="profile_id" value="{{ $profile->id ?? '' }}" form="form_profile"/>
        </div>
    @endif
    <div class="g-col-12">
        <x-app.profile.avatar :profile="isset($profile) && $profile ? $profile : null" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="text" name="name" label="Name" placeholder="You Name" form="form_profile" :value="old('name', $profile->name ?? '')" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="text" name="last_name" label="Last name" placeholder="You Last name"
            form="form_profile" :value="old('last_name', $profile->last_name ?? '')" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="text" name="address" label="Address" placeholder="You Address" form="form_profile" :value="old('address', $profile->address ?? '')"/>
    </div>
</div>
