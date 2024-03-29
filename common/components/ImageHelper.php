<?php
namespace common\components;

use Yii;
use yii\helpers\Url;
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

	public static function updateImageAttribute($model, $attribute, $imageFile, $cropForm = false, $watermark = false) 
	{
        if(!file_exists(self::PATH_ROOT.self::PATH)) {
            mkdir(self::PATH_ROOT.self::PATH, 0775, true);
        }
    
        $fileName = self::PATH.$model->imageNamePrefix.'_'.$model->tableSchema->name.'_'.$attribute.'_'.$model->id.'_'.date('d_m_Y_H:i:s', time()).'.'.$imageFile->extension;
        $model->$attribute = $fileName;
        $imageFile->saveAs(self::PATH_ROOT.$fileName);

        if($imageFile->type !== 'image/svg+xml') {
            if($cropForm) {
                $imgWidth = getimagesize(self::PATH_ROOT.$fileName)[0];
                
                if($imgWidth < $cropForm['imageWidth']) {
                    Image::getImagine()->open(self::PATH_ROOT.$fileName)->resize(new \Imagine\Image\Box($cropForm['imageWidth'], $cropForm['imageHeight']))->save(self::PATH_ROOT.$fileName);
                } else {
                    Image::crop(self::PATH_ROOT.$fileName, $cropForm['width'], $cropForm['height'], [$cropForm['x'], $cropForm['y']])
                        ->save(self::PATH_ROOT.$fileName);

                    Image::thumbnail(self::PATH_ROOT.$fileName, $cropForm['imageWidth'], $cropForm['imageHeight'])
                        ->save(self::PATH_ROOT.$fileName);
                }
            }

            if($watermark) {
                self::drawWatermarks(self::PATH_ROOT.$fileName, $watermark);
            }
        }

        if(isset(Yii::$app->webdavFs)) {                    
            $content = file_get_contents(self::PATH_ROOT.$fileName);
            unlink(self::PATH_ROOT.$fileName);

            Yii::$app->webdavFs->put('events/'.$fileName, $content);
        }
        
        Yii::$app->db->createCommand()
            ->update($model->tableSchema->name, [$attribute => $model->$attribute], 'id = "'.$model->id.'"')
            ->execute();
    }

    public static function drawWatermarks($imageFile, $watermark)
    {      
        foreach ($watermark as $params) {
            if($params['type'] == 'text') {
                $fontFile = self::PATH_ROOT.'/css/fonts/ProximaNova/Proxima_Nova_Bold.otf';
                Image::text($imageFile, $params['text'], $fontFile, $params['position'], $params['style'])
                    ->save($imageFile);
            } elseif($params['type'] == 'image') {
                $image = self::PATH_ROOT.$params['image'];
                Image::watermark($imageFile, $image, $params['position'])
                    ->save($imageFile);
            }
        }
    }

    public static function watermarkTypes()
    {
        return [
            0 => ['label' => '---'],
            1 => ['label' => 'Белый', 'color' => 'fff', 'logoImage' => '/images/logo/white/logo.png', 'gradientImage' => '/images/logo/white/gradient.png'],
            2 => ['label' => 'Синий', 'color' => '232372', 'logoImage' => '/images/logo/blue/logo.png', 'gradientImage' => '/images/logo/blue/gradient.png'],
        ];
    }

    public static function watermarkTypesList()
    {
        $wmList = [];
        foreach (self::watermarkTypes() as $key => $value) {
            $wmList[$key] = $value['label'];
        }

        return $wmList;
    }

    public static function deleteImageAttribute($model, $attribute) 
    {
        $fileName = explode('?', $model->$attribute)[0];
        if(isset(Yii::$app->webdavFs)) {                    
            Yii::$app->webdavFs->delete('events/'.$fileName);
        } else {
            if(file_exists(self::PATH_ROOT.$fileName)) {
                unlink(self::PATH_ROOT.$fileName);
            }
        }
        
        $model->$attribute = null;
        
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
}