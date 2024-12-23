<div class="">
    @if ($rating)
        @for ($i = 0; $i < 5; $i++)
            @if ($i <= round($rating))
                @if ($rating - $i >= 1)
                    <i class="ri-star-fill"></i>
                @elseif ($rating - $i >= 0.5)
                    <i class="ri-star-half-line"></i>
                @else
                    <i class="ri-star-line"></i>
                @endif
            @else
                <i class="ri-star-line"></i>
            @endif
        @endfor
    @else
        No rating yet!
    @endif
</div>
