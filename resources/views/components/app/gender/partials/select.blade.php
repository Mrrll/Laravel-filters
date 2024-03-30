<select name="gender" class="form-select" aria-label="Default select example" form="{{ $form }}">
    <option selected>Open this select menu</option>
    @foreach ($genders as $gender)
        <option value="{{ $gender->id }}" @selected(old('gender', $gender->id) == $select)>@lang($gender->name)</option>
    @endforeach
</select>
