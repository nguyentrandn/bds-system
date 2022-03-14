<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadImages
{
    public static function uploadProfileImages($file, $user_id){
        if (is_null($file)) {
            return null;
        }
        $image_path_base = implode('/', [
            $user_id . '-profile-img-' . sha1_file($file->getRealPath())
        ]);

        $file_contents = file_get_contents($file->getRealPath());

        $file_path = self::generateProfileImageFilePath('public/images/profile/', $image_path_base,$file);
        $image = Image::make($file_contents);
        Storage::disk('local')->put($file_path, $image->encode('png'), 'public');

        return self::generateProfileImageFilePath('/storage/images/profile/', $image_path_base,$file);
    }

    public static function uploadIdentifyImages($file){
        if (is_null($file)) {
            return null;
        }
        $result = [];

        $image_name = $file->getClientOriginalName();
        $image_path_base = implode('/', [
            'identify-img' . '-' . sha1_file($file->getRealPath())
        ]);

        $file_contents = file_get_contents($file->getRealPath());

        $file_path = self::generateProfileImageFilePath('public/images/identify/', $image_path_base, $file);
        $image = Image::make($file_contents);

        Storage::disk('local')->put($file_path, $image->encode('png'), 'public');

        $type = pathinfo($image_path_base, PATHINFO_EXTENSION);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($file_contents);

        $result['identify_image_src'] = $base64;
        $result['identify_image_name'] = $image_name;

        return $result;
    }

    public static function generateProfileImageFilePath($prefix, $image_path_base, $file): string
    {
        return $prefix . $image_path_base  . '.' . $file->getClientOriginalExtension();
    }

    public static function uploadAvatar($file){
        if (is_null($file)) {
            return null;
        }
        $image_path_base = implode('/', [
            'avatar' . '-' . sha1_file($file->getRealPath())
        ]);

        $file_contents = file_get_contents($file->getRealPath());

        $file_path = self::generateProfileImageFilePath('public/images/avatar/', $image_path_base,$file);
        $image = Image::make($file_contents);
        Storage::disk('local')->put($file_path, $image->encode('png'), 'public');

        return self::generateProfileImageFilePath('/storage/images/avatar/', $image_path_base,$file);
    }
}
