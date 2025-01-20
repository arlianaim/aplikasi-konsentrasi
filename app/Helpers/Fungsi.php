<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Self_;

class Fungsi
{
    public static function rupiah($amount, $prefix = 'Rp. ')
    {
        return $prefix . number_format($amount, 0, ',', '.');
    }

    public static function image(String $image, String $type = 'house')
    {
        $image_404 = 'images/404.png';
        $filename = $image;

        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        $fileFound = null;

        foreach ($extensions as $ext) {
            if ($type == 'house') {
                $filePath = $image;
            } else {
                $filePath = "images/$type/{$filename}.{$ext}";
            }

            if (Storage::disk('public')->exists($filePath)) {
                $fileFound = $filePath;
                break;
            }
        }

        if ($fileFound) {
            $image = $fileFound;
        } else {
            $image = $image_404;
        }
        return $image;
    }

    public static function icon($image)
    {
        $image = Self::image($image, 'icon');
        return Storage::url($image);
    }
}
