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
            [['title', 'image', 'text', 'twitter'], 'safe'],
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
        ];
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web';
    }

    public function getImageUrl($image, $thumb_size = false) {
        if(is_file($this->imageSrcPath.$image)) {
            return $image;
        } else {
            return ThumbnailImage::getExternalImageUrl($image, $thumb_size, 'event');
        }
    }
}
