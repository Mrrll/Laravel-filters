{{-- Configuración de los labels --}}
@if ($label)
    @if (!empty($errors->getBags()))
        @foreach ($errors->getBags() as $key => $val)
            @if ($errors->$key->get($name))
                <div class="d-flex justify-content-between">
                    <label for="{{ $id ?? '' }}" class="ms-1">
                        @lang($label)
                    </label>
                    <small id="message_errors" class="text-danger">*{{ $errors->$key->first($name) }}</small>
                </div>
            @else
                <label for="{{ $id ?? '' }}" class="ms-1">
                    @lang($label)
                </label>
            @endif
        @endforeach
    @else
        @error($name)
            <div class="d-flex justify-content-between">
                <label for="{{ $id ?? '' }}" class="ms-1">
                    @lang($label)
                </label>
                <small id="message_errors" class="text-danger">*{{ $message }}</small>
            </div>
        @else
            <label for="{{ $id ?? '' }}" class="ms-1">
                @lang($label)
            </label>
        @enderror
    @endif
@endif

{{-- Tipos de inputs --}}
@switch($type)
    @case('textarea')
        <textarea type="textarea" name="{{ $name }}" id="{{ $id ?? '' }}"
            @if (!empty($errors->getBags())) @foreach ($errors->getBags() as $key => $val)
                @if ($errors->$key->get($name))
                    {{ $attributes->merge(['class' => 'form-control is-invalid']) }} @endif
            @endforeach @else
            @error($name)
                {{ $attributes->merge(['class' => 'form-control is-invalid']) }}
            @enderror
            @endif {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}"
            clo="{{ $col }}" rows="{{ $rows }}" @if ($readonly) @readonly(true) @endif
            @if ($disabled) @disabled(true) @endif
            @if ($form) form="{{ $form }}" @endif>
            {{ old($name, $slot) }}
        </textarea>
    @break

    @default
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id ?? '' }}"
            @if (!empty($errors->getBags())) @foreach ($errors->getBags() as $key => $val)
                @if ($errors->$key->get($name))
                    {{ $attributes->merge(['class' => 'form-control is-invalid']) }} @endif
            @endforeach
    @else
        @error($name)
                {{ $attributes->merge(['class' => 'form-control is-invalid']) }}
            @enderror
        @endif
        {{ $attributes->merge(['class' => "form-control $class"]) }} placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        @if ($readonly) @readonly(true) @endif
        @if ($disabled) @disabled(true) @endif
        @if ($form) form="{{ $form }}" @endif
        >
    @endswitch

    {{-- Si no hay label mostramos el error debajo  --}}
    @if (!$label)
        @foreach ($errors->getBags() as $key => $val)
            @if ($errors->$key->get($name))
                <div class="d-flex">
                    <small id="message_errors" class="text-danger">*{{ $errors->$key->first($name) }}</small>
                </div>
            @endif
        @endforeach
        @error($name)
            <div class="d-flex">
                <small id="message_errors" class="text-danger">*{{ $message }}</small>
            </div>
        @enderror
    @endif
