<?php

namespace App\Helpers;

use App\Helpers\Enum\Path;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author JorgeCoronelG
 * @version 1.0
 * Created 21/12/2021
 */
class File
{
    /**
     * @throws Exception
     */
    public static function uploadImage(UploadedFile $imageFile, string $customPath, int $width = 500, int $height = 500): string
    {
        try {
            $imageName = $imageFile->hashName();
            $pathUrl = self::getFilePublicPath($customPath, $imageName);
            Image::make($imageFile)
                ->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->save($pathUrl);
            return $imageName;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public static function deleteFile(string $path, string $filename): void
    {
        Storage::delete(self::getFileStoragePath($path, $filename));
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

    public static function getExposedPath(string $path, string $filename = null): string
    {
        return (!is_null($filename))
            ? Path::STORAGE->value.$path.$filename
            : Path::STORAGE->value.$path;
    }
}
