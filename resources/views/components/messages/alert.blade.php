<x-messages.partials.icons />
<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    @if ($icon)
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="{{ $type }}:">
            <use xlink:href="{{ ($type == 'danger') ? '#warning-fill': '#'.$type.'-fill' }}" />
        </svg>
    @endif
    {{ $slot }}
    @if ($close)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>
