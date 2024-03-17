<div class="grid align-items-center" style="--bs-gap: 1rem;">
    <div class="g-col-12">
        <x-dom.input type="email" name="email" label="Email address" placeholder="You Email address"
            form="form_register" />
    </div>
    <div class="g-col-12">
        <div class="d-flex justify-content-between">
            <label class="align-self-center" for="">@lang('Password')</label>
            <x-dom.button type='modal' class="btn-sm me-1 btn-link" name="forgot-password">
                @lang('Forgot Your Password?')
            </x-dom.button>
        </div>
        <x-dom.input type="password" name="password" placeholder="You Password" form="form_register" />
    </div>
    <div class="g-col-12 text-center">
        <div class="form-check form-switch d-flex justify-content-center">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="remember" form="form_register">
            <label class="form-check-label ms-1" for="flexSwitchCheckDefault">
                @lang('Remember Me')
            </label>
        </div>
    </div>
</div>
