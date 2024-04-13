<div class="list-group list-group-flush">
    <x-dom.button type="button"
        class="list-group-item list-group-item-action dropdown-toggle border border-top-1 rounded-0 btn-collapse"
        aria-current="true" data-bs-toggle="collapse" data-bs-target="#collapseGender">
        @lang('Gender')
    </x-dom.button>
    <div id="collapseGender" class="collapse list-group list-group-flush">
        <li class="list-group-item list-group-item-action">
            @isset($genders)
                <div class="form-check">
                    <input class="form-check-input filter" type="radio" name="gender" id="all" value="all"
                        checked>
                    <label class="form-check-label" for="all">
                        @lang('All')
                    </label>
                </div>
                @foreach ($genders as $gender)
                    <div class="form-check">
                        <input class="form-check-input filter" type="radio" name="gender" id="{{ $gender->name }}"
                            value="{{ $gender->name }}">
                        <label class="form-check-label" for="{{ $gender->name }}">
                            {{ $gender->name }}
                        </label>
                    </div>
                @endforeach
            @endisset
        </li>
    </div>
</div>
