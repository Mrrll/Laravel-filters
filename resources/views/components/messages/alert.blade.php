<x-messages.partials.icons />

<div class="alert alert-{{ $type }} {{ ($close) ? 'alert-dismissible' : '' }} fade show" role="alert">
    <div class="d-flex align-items-center mb-2">
        @if ($icon)
            <svg class="bi flex-shrink-0 me-2" width="48" height="48" role="img"
                aria-label="{{ $type }}:">
                <use xlink:href="#{{ $type }}-fill" />
            </svg>
        @endif
        {{ $title ?? '' }}
    </div>
    {{ $slot }}
    @if ($close)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
