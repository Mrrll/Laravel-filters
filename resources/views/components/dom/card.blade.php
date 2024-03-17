@props(['class' => ''])

<div {{ $attributes->class(['card ' . $class]) }}>
    {{ $header ?? '' }}
    <div class="card-body">
        {{ $slot }}
    </div>
    {{ $footer ?? '' }}
</div>
