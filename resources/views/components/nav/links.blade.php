<ol class="navbar-nav">
    @foreach ($links as $key => $buttons)
        @if ($key == $name)
            <li class="nav-item">
                @foreach ($buttons as $button)
                    <x-dom.button
                        :type="$button['type']"
                        :class="request()->routeIs($button['route'])
                            ? $button['class'] . ' active disabled'
                            : $button['class']"
                        :id="$button['slug']"
                        :route="route($button['route'])">
                            @if (isset($button['icon']))
                                @switch($button['icon']['type'])
                                    @case('view')
                                        {{ view($button['icon']['name']) }}
                                    @break
                                    @case('componet')
                                        {{ $button['icon']['name'] }}
                                    @break
                                        <i class="{{ $button['icon']['name'] }}" style="color:{{ $button['icon']['color']}}"></i>
                                    @default
                                @endswitch
                            @endif
                            @lang($button['name'])
                    </x-dom.button>
                @endforeach
            </li>
        @endif
    @endforeach
</ol>
