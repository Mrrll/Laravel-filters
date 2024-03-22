@props(['profile'])

<label id="avatar" for="avatarFile" class="d-flex justify-content-center">
    <div id="preview_avatar">
        <div class="avatar">
            @if (isset($profile) && $profile && $profile->image->first())
                <img height="120px" width="120px"
                    src="{{ route('private', ['file' => $profile->image->first()->fileName]) }}">
                <div id="btn_delete_avatar">
                    <x-dom.button type="button" class="btn btn-close btn-close-white" onclick="DeleteAvatar()"
                        :tooltip="[
                            'position' => 'top',
                            'class' => 'custom-tooltip',
                            'text' => 'Delete Avatar',
                        ]" />
                </div>
            @else
                <x-svg.avatar color="#000000" height="120px" width="120px" />
            @endif
        </div>
    </div>
    {{-- Imagen del cambio --}}
    <div class="form-group text-center g-col-12 g-col-md-4 avatar">
        <img id="avatarPreview" class="avatar d-none" height="120px" width="120px">
    </div>
</label>
<input class="form-control d-none" type="file" id="avatarFile" name="avatar" accept="image/png" form="form_profile"
    onchange="previewImage(event, '#avatarPreview', '#preview_avatar')">
