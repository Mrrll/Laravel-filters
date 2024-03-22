<header class="bg-light border-bottom">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                @auth

                    <ol class="navbar-nav d-lg-none">
                        <li class="nav-item">
                            <hr>
                        </li>
                        <li class="nav-item">
                            <x-dom.button type="modal" class="nav-link" route="profile">
                                <x-nav.users.user-profiles :menu="false" />
                            </x-dom.button>
                        </li>
                        <li class="nav-item">
                            <hr>
                        </li>
                    </ol>

                @endauth
                <div class="d-lg-flex">
                    <x-nav.links name="links" />
                    @can('isAdmin')
                        <x-nav.links name="admin" />
                    @else
                        @auth
                            <x-nav.links name="links_auth" />
                        @endauth
                    @endcan
                </div>
                @guest
                    <x-nav.links name="login" />
                @endguest
                @auth
                    <div class="d-none d-lg-flex">
                        <x-nav.users.user-profiles />
                    </div>
                @endauth
                @auth
                    <ol class="navbar-nav d-lg-none">
                        <li class="nav-item">
                            <hr>
                        </li>
                        <li class="nav-item">
                            <x-dom.form :action="route('logout')" :valid="false">
                                <x-dom.button type="submit" class="dropdown-item">
                                    @lang('Logout')
                                </x-dom.button>
                            </x-dom.form>
                        </li>
                    </ol>
                @endauth
            </div>
        </div>
    </nav>
</header>
