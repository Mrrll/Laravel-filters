<div id="{{ $id }}" class="modal fade" tabindex="-1" aria-hidden="true"
    @if ($static) data-bs-backdrop="static" data-bs-keyboard="false" @endif>
    <div class="modal-dialog {{ $class }} {{ $centered ? 'modal-dialog-centered' : '' }} {{ $scrollable ? 'modal-dialog-scrollable' : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>
                @if ($close)
                    <x-dom.button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></x-dom.button>
                @endif
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if ($footer)
                <div class="modal-footer">
                    @if ($close)
                        <x-dom.button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Close</x-dom.button>
                    @endif
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
