<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class Settings extends \yii\db\ActiveRecord
{
    const TYPE_STRING = 1;
    const TYPE_TEXT = 2;
    const TYPE_CHECKBOX_LIST = 3;
    const TYPE_IMAGE = 5;
    const TYPE_FILE = 6;

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['value'], 'required'],
            [['key', 'title'], 'string', 'max' => 100],
            [['value'], 'safe'],
            ['type', 'integer'],
            [['imageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxSize'=>1024 * 1024 * 5, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'value' => 'Значение',
            'title' => 'Заголовок',
            'imageFile' => 'Изображение',
        ];
    }

    public function beforeSave($insert) {
        if($this->type == self::TYPE_CHECKBOX_LIST) {
            $this->value = json_encode($this->value);
        }

        return parent::beforeSave($insert);
    }


    public function afterFind() {
        if($this->type == self::TYPE_CHECKBOX_LIST) {
            $this->value = json_decode($this->value);
        }
    }

    public function getSettings() {
        $settings = static::find()->all();
        return ArrayHelper::map($settings, 'key', 'value');
    }

    public function setSetting($key, $value) {
        $model = static::findOne(['key' => $key]);
        if ($model === null) {
            $model = new static();
        }
        $model->key = $key;
        $model->value = strval($value);

        return $model->save();
    }

    public function findSetting($key) {
        return $this->find()->where(['key' => $key])->one();
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web/uploads/';
    }

    public function getSocials() {
        return [
            'fb' => 'fb',
            'tw' => 'tw', 
            'ok' => 'ok', 
            'vk' => 'vk', 
            'tg' => 'tg'
        ];
    }
}
