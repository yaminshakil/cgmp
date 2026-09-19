<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploader
{
    public static function store(UploadedFile $file, string $folder, int $maxWidth = 1600): string
    {
        $filename = $folder . '/' . Str::random(20) . '.jpg';

        $manager = new ImageManager(new Driver);
        $image = $manager->read($file->getRealPath())->scaleDown(width: $maxWidth);

        Storage::disk('public')->put($filename, (string) $image->toJpeg(quality: 82));

        return $filename;
    }

    /**
     * Stores logos as PNG (or raw SVG) instead of JPEG so transparent backgrounds survive.
     */
    public static function storeLogo(UploadedFile $file, string $folder = 'branding', int $maxWidth = 480): string
    {
        if (strtolower($file->getClientOriginalExtension()) === 'svg') {
            $filename = $folder . '/' . Str::random(20) . '.svg';
            Storage::disk('public')->put($filename, file_get_contents($file->getRealPath()));

            return $filename;
        }

        $filename = $folder . '/' . Str::random(20) . '.png';

        $manager = new ImageManager(new Driver);
        $image = $manager->read($file->getRealPath())->scaleDown(width: $maxWidth);

        Storage::disk('public')->put($filename, (string) $image->toPng());

        return $filename;
    }
}
