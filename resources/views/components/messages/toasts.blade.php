<x-messages.partials.icons />

<div class="toast {{ $type != 'info' ? 'text-white' : '' }} bg-{{ $type }}" role="alert" aria-live="assertive"
    aria-atomic="true" data-bs-delay="{{ $delay }}" data-bs-autohide="{{ $autohide }}">
    <div class="toast-header {{ $type != 'info' ? 'text-white' : '' }} bg-{{ $type }}">
        @if ($icon)
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                aria-label="{{ ucfirst($type) }} :">
                <use xlink:href="#{{ $type }}-fill" />
            </svg>
        @endif
        <strong class="me-auto">@lang(ucfirst($title))</strong>
        <small id="date_toast" class="{{ $type != 'info' ? 'text-white' : '' }}"></small>
        <button id="close_toats" type="button" class="btn-close {{ $type != 'info' ? 'btn-close-white' : '' }}"
            aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $slot }}
    </div>
    @if ($autohide == 'true')
        <div class="progress rounded-bottom justify-content-end bg-gray-400" style="height: 7px;">
            <div class="progress-bar bg-{{ $type }}" role="progressbar"></div>
        </div>
    @endif
</div>
