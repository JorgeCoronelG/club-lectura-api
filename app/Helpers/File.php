<?php

namespace App\Helpers;

use App\Helpers\Enum\Path;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 21/12/2021
 */
class File
{
    public const IMAGE_HEIGHT = 512;
    public const IMAGE_NAME_LENGHT = 40;
    public const IMG_USER_SIZE = 10240;

    /**
     * @throws \Exception
     */
    public static function uploadImage(UploadedFile $imageFile, string $customPath): string
    {
        try {
            $imageName = Str::random(self::IMAGE_NAME_LENGHT).
                self::getFileExtension($imageFile->getClientOriginalName());
            $pathUrl = self::getFilePublicPath($imageName, $customPath);
            Image::make($imageFile)
                ->resize(null, self::IMAGE_HEIGHT, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($pathUrl);
            return $imageName;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public static function deleteFile(string $filename, string $path): void
    {
        Storage::delete(self::getFileStoragePath($filename, $path));
    }

    public static function getFileExtension(string $file): string
    {
        return '.'.pathinfo($file, PATHINFO_EXTENSION);
    }

    public static function getFilePublicPath(string $filename, string $path): string
    {
        return public_path(Path::STORAGE->value.$path.$filename);
    }

    public static function getFileStoragePath(string $filename, string $path): string
    {
        return Path::STORAGE_PUBLIC->value.$path.$filename;
    }
}
