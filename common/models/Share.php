<?php

namespace common\models;

use Yii;
use common\components\ThumbnailImage;

/**
 * This is the model class for table "{{%share}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property EventShare[] $eventCategories
 */
class Share extends \yii\db\ActiveRecord
{
    public $url;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%share}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'image', 'text', 'twitter'], 'required'],
            [['title', 'image', 'text', 'twitter', 'year_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Номер месяца',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'twitter' => 'Текст для Twitter',
            'image' => 'Изображение',
            'year_id' => 'Год',
        ];
    }

    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web';
    }

    public function getImageUrl($image = false, $thumb_size = false) {
        if(!$image) {
            $image = $this->image;
        }
        
        if(is_file($this->imageSrcPath.$image)) {
            return $image;
        } else {
            return ThumbnailImage::getExternalImageUrl($image, $thumb_size, 'event');
        }
    }
}
