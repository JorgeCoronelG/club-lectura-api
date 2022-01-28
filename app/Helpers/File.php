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
    const IMAGE_HEIGHT = 512;
    const IMAGE_NAME_LENGHT = 40;

    /**
     * @throws \Exception
     */
    public static function uploadImage(UploadedFile $imageFile, string $customPath): string
    {
        try {
            $imageName = Str::random(self::IMAGE_NAME_LENGHT).
                self::getFileExtension($imageFile->getClientOriginalName());
            $pathUrl = self::getFilePublicPath($customPath, $imageName);
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

    public static function getFilePublicPath(string $path, string $filename = null): string
    {
        return (!is_null($filename))
            ? public_path(Path::STORAGE->value.$path.$filename)
            : public_path(Path::STORAGE->value.$path);
    }

    public static function getFileStoragePath(string $path, string $filename = null): string
    {
        return (!is_null($filename))
            ? Path::STORAGE_PUBLIC->value.$path.$filename
            : Path::STORAGE_PUBLIC->value.$path;
    }
}
