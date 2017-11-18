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

	public static function thumbnailFile($filename, $width, $height, $mode = self::THUMBNAIL_OUTBOUND, $imageDir = false) {
        // $filename = FileHelper::normalizePath(Yii::getAlias($filename));
        // if (!is_file($filename)) {
        //     throw new FileNotFoundException("File $filename doesn't exist");
        // }
        $cachePath = __DIR__ . '/../../frontend/web/'.self::$cacheAlias;

        $explode = explode('/', $filename);
        $file = end($explode);
        $explode = explode('.', $file);
        $thumbnailFileExt = '.'.end($explode);
        unset($explode[end($explode)]);
        $thumbnailFileName = implode('.', $explode);
        $thumbnailFilePath = $cachePath . DIRECTORY_SEPARATOR . $imageDir;
        $thumbnailFileName = $thumbnailFileName .'_'. $width .'x'. $height;
        $thumbnailFile = $thumbnailFilePath . DIRECTORY_SEPARATOR . $thumbnailFileName . $thumbnailFileExt;
        echo $thumbnailFile;

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
        //$filename = FileHelper::normalizePath(Yii::getAlias($filename));
        $cacheUrl = self::$cacheAlias;
        $cachePath = self::$cacheAlias;
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