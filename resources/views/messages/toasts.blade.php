@if (session('message'))
    <div class="toast-container position-absolute {{ session('message')['position'] ?? 'top-0 end-0' }} p-3">
        <x-messages.toasts type="{{ session('message')['type'] ?? 'info' }}"
            delay="{{ session('message')['delay'] ?? '5000' }}" :autohide="session('message')['autohide'] ?? 'true'" :icon="session('message')['icon'] ?? true">
            <x-slot:title>
                {{ session('message')['title'] ?? '' }}
            </x-slot:title>
            {{ session('message')['message'] ?? '' }}
        </x-messages.toasts>
    </div>
@endif
