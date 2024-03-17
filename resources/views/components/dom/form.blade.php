<form id="{{ $id ?? '' }}" action="{{ $action }}"
    @if (strtoupper($method) == 'GET') method="{{ strtoupper($method) }}"
@else
    method="POST" @endif
    enctype="{{ $enctype }}"
    @if ($valid) onsubmit="return validateForm(event)" @endif>
    @if (strtoupper($method) != 'GET')
        @csrf
    @endif
    @if (strtoupper($method) != 'GET' && strtoupper($method) != 'POST')
        @method($method)
    @endif
    {{ $slot }}
</form>
