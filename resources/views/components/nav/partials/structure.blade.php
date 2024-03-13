@props(['items'])
@foreach ($items as $item)
    <li class="nav-item">
        <x-dom.button
        :type="$item['type']"
        :id="$item['slug']"
        :class="(isset($item['route']) && request()->routeIs($item['route']) ? $item['class']. ' active disabled' : $item['class'])"
        :route="(isset($item['route'])) ? $item['route'] : null"
        :position="(isset($item['position'])) ? $item['position'] : ''">
            @if ($item['type'] == 'dropdown')
                <x-slot:title>
                    {{ $item['name'] }}
                </x-slot:title>
            @else
                {{ $item['name'] }}
            @endif

            @if (isset($item['items']))
                <ul class="dropdown-menu">
                    <x-nav.partials.structure :items="$item['items']" />
                </ul>
            @endif
        </x-dom.button>
    </li>
@endforeach
