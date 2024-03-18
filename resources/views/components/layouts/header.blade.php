<header class="bg-light border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <x-nav.links name="links" />
                @guest
                    <x-nav.links name="login" />
                @endguest
                @auth
                    <x-dom.form :action="route('logout')" :valid="false">
                        <x-nav.links name="auth_login" />
                    </x-dom.form>
                @endauth
            </div>
        </div>
    </nav>
</header>
