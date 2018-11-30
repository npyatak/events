<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

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
    public $imageFile;

    public $imageNamePrefix;
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
            [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg, svg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png, image/svg+xml'],
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
            'imageFile' => 'Изображение',
            'year_id' => 'Год',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        $this->imageNamePrefix = $this->id;

        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        if($this->imageFile) {
            Yii::$app->image->updateImageAttribute($this, 'image', $this->imageFile);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id']);
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web';
    }
}
