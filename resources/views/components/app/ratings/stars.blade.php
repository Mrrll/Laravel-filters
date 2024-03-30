@props(['rating' => 0])

@php
    $v = explode('.', $rating);
    $stars = $rating != 0 ? 5 - ceil($rating) : 5;
@endphp

<div class="d-flex justify-content-center mt-1 mb-2 stars">
    @if ($rating != 0)
        @for ($i = 0; $i < $v[0]; $i++)
            <i class="fa-solid fa-star fa-xl" style="color: #FFD43B;"></i>
        @endfor
        @if (isset($v[1]))
            <i class="fa-solid fa-star-half-stroke fa-xl" style="color: #FFD43B;"></i>
        @endif
    @endif
    @for ($i = 0; $i < $stars; $i++)
        <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
    @endfor
</div>
