<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.input type="hidden" name="token" value="{{ $token }}" form="form_reset" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="email" name="email" label="Email address" placeholder="You Email address" :readonly="true" value="{{ old('email', $email) }}" form="form_reset" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="password" name="password" label="Password" placeholder="You Password" form="form_reset" />
    </div>
    <div class="g-col-12">
        <x-dom.input type="password" label="Password Confirmation" name="password_confirmation"
            placeholder="You Confirmation Password" form="form_reset" />
    </div>
</div>
