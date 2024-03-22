<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Upload
{
    public static function Upload($request, $key, $dir = null, $name = null, $storage = "public")
    {
        $data = $request->validated();
        if ($name == null) {
            $filename = $data[$key]->getClientOriginalName();
        } else {
            $filename = $name . '.' . $data[$key]->extension();
        }

        $data[$key]->storeAs($dir, $filename, $storage);

        return $dir != null ? $dir . '/' . $filename : $filename;
    }
    public static function Del(String $ruta, String $storage = "public")
    {
        return Storage::disk($storage)->delete($ruta);
    }
    public static function Rename(String $ruta_old, String $ruta_new)
    {
        return (rename($ruta_old, $ruta_new)) ? $ruta_new : false;
    }
}
