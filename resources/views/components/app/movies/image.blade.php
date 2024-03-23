<label id="image" for="imageFile" class="d-flex justify-content-center">
    <div id="preview_image">
        <div class="avatar">
            @if (isset($movie) && $movie && $movie->image->first())
                <img height="120px" width="120px"
                    src="{{ route('private', ['file' => $movie->image->first()->fileName]) }}">
                <div id="btn_delete_image">
                    <x-dom.button type="button" class="btn btn-close btn-close-white" onclick="DeleteAvatar()"
                        :tooltip="[
                            'position' => 'top',
                            'class' => 'custom-tooltip',
                            'text' => 'Delete Image',
                        ]" />
                </div>
            @else
                <x-svg.image color="#000000" height="48px" width="150px" />
            @endif
        </div>
    </div>
    {{-- Imagen del cambio --}}
    <div class="form-group text-center g-col-12 g-col-md-4 avatar">
        <img id="imagePreview" class="avatar d-none" height="120px" width="120px">
    </div>
</label>
<input class="form-control d-none" type="file" id="imageFile" name="image" accept="image/png,jpg,jpeg,gif,bmp"
    form="form_movie" onchange="previewImage(event, '#imagePreview', '#preview_image')">
