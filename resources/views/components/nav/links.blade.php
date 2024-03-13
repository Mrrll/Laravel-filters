@foreach ($links as $link => $buttons)
    @if ($link == $name)
        <ol class="navbar-nav">
            @foreach ($buttons as $button)
                <li class="nav-item">
                    <x-dom.button
                    :type="$button['type']"
                    :id="$button['slug']"
                    :class="(isset($button['route']) && request()->routeIs($button['route']) ? $button['class']. ' active disabled' : $button['class'])"
                    :route="(isset($button['route'])) ? $button['route'] : ''"
                    :position="(isset($button['position'])) ? $button['position'] : ''">
                        @if ($button['type'] == 'dropdown')
                            <x-slot:title>
                                {{ $button['name'] }}
                            </x-slot:title>
                        @else
                            {{ $button['name'] }}
                        @endif

                        @if (isset($button['items']))
                            <ul class="dropdown-menu">
                                <x-nav.partials.structure :items="$button['items']" />
                            </ul>
                        @endif
                    </x-dom.button>
                </li>
            @endforeach
        </ol>
    @endif
@endforeach
