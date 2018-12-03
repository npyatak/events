<?php
namespace common\components;

use Yii;
use yii\helpers\Html;
use yii\imagine\Image;

class ImageHelper {

	const PATH = '/uploads/';
	const PATH_ROOT = __DIR__ . '/../../frontend/web';

    public static function getImageUrl($image, $thumb_size = false) {
        if($image) {
            if(isset(Yii::$app->webdavFs)) {
                $parse = parse_url($image);
                if(isset($parse['scheme'])) {
                    return $image;
                } else {
                    return Yii::$app->cdn->getUrl($image);
                }
            } else if(is_file(self::PATH_ROOT.$image)) {
                return Url::to($image);
            } else {
                return ThumbnailImage::getExternalImageUrl($image, $thumb_size, 'event');
            }
        }
    }

	public static function updateImageAttribute($model, $attribute, $imageFile, $cropForm = false) 
	{
        if(!file_exists(self::PATH_ROOT.self::PATH)) {
            mkdir(self::PATH_ROOT.self::PATH, 0775, true);
        }
    
        $model->$attribute = self::PATH.$model->imageNamePrefix.'_'.$model->tableSchema->name.'_'.$attribute.'_'.$model->id.'.'.$imageFile->extension;
        $imageFile->saveAs(self::PATH_ROOT.$model->$attribute);

        if($cropForm) {
            Image::crop(self::PATH_ROOT.$model->$attribute, $cropForm['width'], $cropForm['height'], [$cropForm['x'], $cropForm['y']])
                ->save(self::PATH_ROOT.$model->$attribute);

            Image::thumbnail(self::PATH_ROOT.$model->$attribute, $cropForm['imageWidth'], $cropForm['imageHeight'])
                ->save(self::PATH_ROOT.$model->$attribute);
        }

        if(isset(Yii::$app->webdavFs)) {                    
            $content = file_get_contents(self::PATH_ROOT.$model->$attribute);
            unlink(self::PATH_ROOT.$model->$attribute);

            Yii::$app->webdavFs->put('events/'.$model->$attribute, $content);
        }
        
        Yii::$app->db->createCommand()
            ->update($model->tableSchema->name, [$attribute => $model->$attribute], 'id = "'.$model->id.'"')
            ->execute();
    }

    public static function deleteFile($fileName)
    {        
        if(file_exists(self::PATH_ROOT.$fileName)) {
            unlink(self::PATH_ROOT.$fileName);
        }

        if(isset(Yii::$app->webdavFs)) {
            if(Yii::$app->webdavFs->has('events/'.$fileName)) {
                Yii::$app->webdavFs->delete('events/'.$fileName);
            }
        }
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../../frontend/web';
    }

    public function getPath() {
        return '/uploads/';
    }
}