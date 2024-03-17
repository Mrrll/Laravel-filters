@if ($label)
    <label for="{{ $id ?? '' }}" class="ms-1">
        @lang($label)
    </label>
@endif

@switch($type)
    @case('textarea')
        <textarea type="textarea" name="{{ $name }}" {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}" clo="{{ $col }}" rows="{{ $rows }}"
        @if ($readonly)
            @readonly(true)
        @endif
        @if ($disabled)
            @disabled(true)
        @endif
        @if ($form)
            form="{{ $form }}"
        @endif
        >
            {{ old($name, $slot) }}
        </textarea>
    @break

    @default
        <input type="{{ $type }}" name="{{ $name }}" {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
        @if ($readonly)
            @readonly(true)
        @endif
        @if ($disabled)
            @disabled(true)
        @endif
        @if ($form)
            form="{{ $form }}"
        @endif
        >
@endswitch
