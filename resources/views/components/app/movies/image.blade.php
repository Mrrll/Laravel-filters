<label id="image" for="imageFile" class="d-flex justify-content-center">
    <div id="preview_image">
        @if (isset($movie) && $movie && $movie->image->first())
            <div class="card-image"
                style="background:url('{{ asset('storage/' . $movie->image->first()->url) }}');min-height:100px !important">

                <div id="btn_delete_image">
                    <x-dom.button type="button" class="btn btn-close btn-close-white" onclick="DeleteImage()"
                        :tooltip="[
                            'position' => 'top',
                            'class' => 'custom-tooltip',
                            'text' => 'Delete Image',
                        ]" />
                </div>
            </div>
        @else
            <div class="select-image" style="width:100%;min-height:100px !important">
                <span>@lang('Select to image film')</span>
            </div>
        @endif
    </div>
    {{-- Imagen del cambio --}}
    <div class="form-group text-center d-none" style="width:100%">
        <div id="imagePreview" class="card-image" style="min-height:100px !important">
        </div>
    </div>
</label>
<input class="form-control d-none" type="file" id="imageFile" name="image" accept="image/png,jpg,jpeg,gif,bmp"
    form="form_movie" onchange="previewImage(event, '#imagePreview', '#preview_image')">
@error('image')
    <div class="d-flex justify-content-between">
        <small id="message_errors" class="text-danger">*{{ $message }}</small>
    </div>
@enderror
