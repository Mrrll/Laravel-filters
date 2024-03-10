<?php

use Illuminate\Support\Facades\Storage;


// Read json
if (!function_exists('read_json')) {
    function read_json(String $dir, String $storage = "public"): Json
    {
        return Storage::disk($storage)->json($dir);
    }
}

// save json
if (!function_exists('save_json')) {
    function save_json(String $dir, array $array, String $storage = "public"): Bool
    {
        return Storage::disk($storage)->put($dir, json_encode($array));
    }
}
