@switch($type)
    @case('link')
        <a href="{{ $route ?? '#' }}" {{ $attributes->merge(['class' => "$class"]) }} id="{{ $id ?? '' }}"
            @isset($tooltip)
                @if ($tooltip != null && $tooltip != '')
                    data-bs-toggle="tooltip"
                    data-bs-placement="{{ $tooltip['position'] }}"
                    @isset($tooltip['class'])
                        data-bs-custom-class="{{ $tooltip['class'] }}"
                    @endisset
                data-bs-title="@lang($tooltip['text'])"
                @endif
            @endisset
        > {{ $slot }} </a>
    @break

    @case('submit')
        <button type="button" {{ $attributes->merge(['class' => "btn $class"]) }} id="{{ $id ?? '' }}"
            @isset($form)
                form="{{ $form }}"
            @endisset
            @isset($tooltip)
                @if ($tooltip != null && $tooltip != '')
                    data-bs-toggle="tooltip"
                    data-bs-placement="{{ $tooltip['position'] }}"
                    @isset($tooltip['class'])
                        data-bs-custom-class="{{ $tooltip['class'] }}"
                    @endisset
                    data-bs-title="@lang( $tooltip['text'])"
                @endif
            @endisset
        >
            {{ $slot }}
        </button>
    @break

    @case('dropdown')
        <div class="{{ $position }}">
            <button type="button" {{ $attributes->merge(['class' => "dropdown-toggle btn $class"]) }} id="{{ $id ?? '' }}" data-bs-toggle="dropdown" aria-expanded="false"
                @isset($tooltip)
                    @if ($tooltip != null && $tooltip != '')
                        data-bs-toggle="tooltip"
                        data-bs-placement="{{ $tooltip['position'] }}"
                        @isset($tooltip['class'])
                            data-bs-custom-class="{{ $tooltip['class'] }}"
                        @endisset
                        data-bs-title="@lang($tooltip['text'])"
                    @endif
                @endisset
            >
                {{-- <x-slot:title>
                    Esto es el titulo del boton
                </x-slot:title> --}}
                {{ $title }}
            </button>
            {{ $slot }}
        </div>
    @break

    @default
        <button type="button" {{ $attributes->merge(['class' => "btn $class"]) }} id="{{ $id ?? '' }}"
            @isset($route)
                onclick="{{ $route }}"
            @endisset
            @isset($tooltip)
                @if ($tooltip != null && $tooltip != '')
                    data-bs-toggle="tooltip"
                    data-bs-placement="{{ $tooltip['position'] }}"
                    @isset($tooltip['class'])
                        data-bs-custom-class="{{ $tooltip['class'] }}"
                    @endisset
                    data-bs-title="@lang($tooltip['text'])"
                @endif
            @endisset
        >
        {{ $slot }}
        </button>
@endswitch
