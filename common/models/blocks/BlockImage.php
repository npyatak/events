<?php

namespace common\models\blocks;

use Yii;
use yii\web\UploadedFile;

class BlockImage extends Block
{
    public $imageFile;

    public static function tableName()
    {
        return '{{%block_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), 
            [
                [['imageFile'], 'required', 'when' => function($model) {
                    return $model->isNewRecord;
                }],
                [['show_fullscreen'], 'integer'],
                [['source', 'copyright_text', 'text'], 'string', 'max' => 255],
                [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
        return 'Изображение';
    }

    public function beforeValidate()
    {        
        $this->imageFile = UploadedFile::getInstance($this, "[$this->key]imageFile");

        if (parent::beforeValidate()) {
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->imageFile) {
            Yii::$app->image->updateImageAttribute($this, 'source', $this->imageFile);
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {        
        if($this->source) {
            Yii::$app->image->deleteFile($this->source);
        }

        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
                'source' => 'Источник',
                'show_fullscreen' => 'На весь экран',
                'copyright_text' => 'Текст копирайта',
                'text' => 'Сопровождающий текст',
            ]
        );
    }
}