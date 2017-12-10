<?php
namespace common\components;

use Yii;
use yii\helpers\Html;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;

class ThumbnailImage {

    const THUMBNAIL_OUTBOUND = ManipulatorInterface::THUMBNAIL_OUTBOUND;
    const THUMBNAIL_INSET = ManipulatorInterface::THUMBNAIL_INSET;

	public static $cacheAlias = 'assets/thumbnails';

    public static $cacheExpire = 0;

    public static function getExternalImageUrl($image, $thumb_size = false, $imageDir = false) {        
        if($image) {
            $file_headers = @get_headers($image);
            if($file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found') {
                if($thumb_size) {
                    $sizes = explode('x', $thumb_size);
                } else {
                    $sizes = getimagesize($image);
                }
                $imageSrc = ThumbnailImage::thumbnailFileUrl(
                    $image,
                    $sizes[0],
                    $sizes[1],
                    ThumbnailImage::THUMBNAIL_INSET,
                    $imageDir
                );
                return $imageSrc;
            }
        } 

        return '';
    }

    public static function getLocalImageUrl($image, $thumb_size = false, $imageDir = false) { 
        if (is_file($image)) {
            if($thumb_size) {
                $sizes = explode('x', $thumb_size);
                $imageSrc = ThumbnailImage::thumbnailFileUrl(
                    $image,
                    $sizes[0],
                    $sizes[1],
                    ThumbnailImage::THUMBNAIL_INSET,
                    $imageDir
                );
                return $imageSrc;
            } else {
                return $image;
            }
        } 

        return '';
    }

	public static function thumbnailFile($filename, $width, $height, $mode = self::THUMBNAIL_OUTBOUND, $imageDir = false) {
        $cachePath = __DIR__ . '/../../frontend/web/'.self::$cacheAlias;
        
        $explode = explode('/', $filename);
        $file = end($explode);
        $explode = explode('.', $file);
        $thumbnailFileExt = '.'.end($explode);
        array_pop($explode);
        $thumbnailFileName = implode('.', $explode);
        $thumbnailFilePath = $cachePath . DIRECTORY_SEPARATOR . $imageDir;
        $thumbnailFileName = $thumbnailFileName .'_'. $width .'x'. $height;
        $thumbnailFile = $thumbnailFilePath . DIRECTORY_SEPARATOR . $thumbnailFileName . $thumbnailFileExt;

        if (file_exists($thumbnailFile)) {
            if (self::$cacheExpire !== 0 && (time() - filemtime($thumbnailFile)) > self::$cacheExpire) {
                unlink($thumbnailFile);
            } else {
                return $thumbnailFile;
            }
        }
        if (!is_dir($thumbnailFilePath)) {
            mkdir($thumbnailFilePath, 0755, true);
        }

        $box = new Box($width, $height);
        $image = Image::getImagine()->open($filename);
        $image = $image->thumbnail($box, $mode);

        $image->save($thumbnailFile);

        return $thumbnailFile;
    }

    public static function thumbnailFileUrl($filename, $width, $height, $mode = self::THUMBNAIL_OUTBOUND, $imageDir) {
        $cacheUrl = self::$cacheAlias;
        $thumbnailFilePath = self::thumbnailFile($filename, $width, $height, $mode, $imageDir);

        preg_match('#[^\\' . DIRECTORY_SEPARATOR . ']+$#', $thumbnailFilePath, $matches);
        $fileName = $matches[0];

        if($imageDir) {
            $path = $cacheUrl . '/' . $imageDir . '/' . $fileName;
        } else {
            $path = $cacheUrl . '/' . $fileName;
        }

        return Yii::$app->urlManagerFrontEnd->createAbsoluteUrl($path);
    }
}