<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;

class Helper
{

    public static function uploadFile($file, $path, $defaultfile, $photoSize = null, $photoSmallSize = null)
    {
        if ($file) {
            $current_timestamp = Carbon::now()->timestamp;
            $filename = $current_timestamp . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path($path), $filename);
            if ($filename && $photoSize) {
                $img = new ImageManager();
                $img = $img->make(public_path($path) . '/' . $filename)->resize($photoSize[0], $photoSize[1])->save($path . '/' . $filename);
                if ($photoSmallSize) {
                    $img2 = new ImageManager();
                    $img2 = $img2->make(public_path($path) . '/' . $filename)->resize($photoSmallSize[0], $photoSmallSize[1])->save($path . '/small-' . $filename);
                }
            }
            return $filename;
        } else {
            return $defaultfile;
        }
    }

    public static function deleteFile($path, $filename, $photoSmall = false)
    {
        File::delete($path . '/' . $filename);
        if ($photoSmall) {
            File::delete($path . '/small-' . $filename);
        }
    }
}
