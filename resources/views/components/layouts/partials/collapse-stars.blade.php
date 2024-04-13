<div class="list-group list-group-flush">

    <x-dom.button id="btn_star" type="button"
        class="list-group-item list-group-item-action dropdown-toggle border border-top-1 rounded-0 btn-collapse"
        aria-current="true" data-bs-toggle="collapse" data-bs-target="#collapseStars">
        @lang('Stars')
    </x-dom.button>

    <input id="checkstar" class="form-check-input d-none" type="checkbox" name="checkstar">

    <div id="collapseStars" class="collapse list-group list-group-flush">
        <li class="list-group-item list-group-item-action">
            <div id="rangeStars" class="d-flex justify-content-center p-3 mb-1">
                <span class="stars">
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                </span>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text pt-2 pb-2">
                    <i class="fa-regular fa-star fa-xl" style="color:#FFD43B;"></i>
                </span>
                <input type="range" class="form-control form-range p-3 filter" min="0" max="5"
                    step="0.5" name="filter_star" value="0" onchange="FilterStars(event)">
                <span class="input-group-text">
                    <i class="fa-solid fa-star fa-xl" style="color: #FFD43B;"></i>
                </span>
            </div>
        </li>
    </div>
</div>
