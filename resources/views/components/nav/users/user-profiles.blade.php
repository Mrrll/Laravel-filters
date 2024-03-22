@props(['menu' => true])

<div class="d-flex align-items-center">

    @if (auth()->user()->profile->first() && auth()->user()->profile->first()->image->first())
        <img height="24px" width="24px"
            src="{{ route('private', ['file' => auth()->user()->profile->first()->image->first()->fileName]) }}">
    @else
        <x-svg.avatar color="#000000" />
    @endif

    <span class="ms-1 me-1"> @lang("Hi"), {{ auth()->user()->profile->first() ? auth()->user()->profile->first()->fullName : auth()->user()->name }}</span>

    @if ($menu)
        <div class="dropdown">
            <button class="btn" type="button"data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static">
                <x-svg.menu-dots color="#000000" />
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li class="nav-item">
                    <x-dom.button type="modal" route="profile" class="dropdown-item">
                        @lang('Profile')
                    </x-dom.button>
                </li>
                {{ $slot }}
                <li class="nav-item">
                    <x-dom.form :action="route('logout')" :valid="false">
                        <x-dom.button type="submit" class="dropdown-item">
                            @lang('Logout')
                        </x-dom.button>
                    </x-dom.form>
                </li>
            </ul>
        </div>
    @endif
</div>
