<?php

namespace common\models\blocks;

use Yii;
use yii\web\UploadedFile;

class BlockFlipCard extends Block
{
    const DEFAULT_WIDTH = 660;
    const DEFAULT_HEIGHT = 400;

    public $imageFrontFile;
    public $imageBackFile;
    public $cropImage = [];
    public $imageFrontCropParams = ['w' => 1320, 'h' => 800, 'attribute' => 'image_front'];
    public $imageBackCropParams = ['w' => 1320, 'h' => 800, 'attribute' => 'image_back'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_flip_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [

                [['image_front', 'image_back', 'control_text', 'capture_front', 'control_text_back', 'capture_back'], 'string', 'max' => 255],
                [['width', 'height'], 'integer', 'max' => 9999],
                [['text_front', 'text_back'], 'safe'],
                [['imageFrontFile', 'imageBackFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
        return 'Флип-карта';
    }

    public function beforeSave($insert) {
        if(!$this->width) {
            $this->width = self::DEFAULT_WIDTH;
        }
        if(!$this->height) {
            $this->height = self::DEFAULT_HEIGHT;
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->imageFrontFile = UploadedFile::getInstance($this, "[$this->key]imageFrontFile");
        if($this->imageFrontFile) {
            if(isset($this->cropImage['imageFrontFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'image_front', $this->imageFrontFile, $this->cropImage['imageFrontFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'image_front', $this->imageFrontFile);
            }
        }

        $this->imageBackFile = UploadedFile::getInstance($this, "[$this->key]imageBackFile");
        if($this->imageBackFile) {
            if(isset($this->cropImage['imageBackFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'image_back', $this->imageBackFile, $this->cropImage['imageBackFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'image_back', $this->imageBackFile);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {        
        if($this->image_front) {
            Yii::$app->image->deleteFile($this->image_front);
        }
        
        if($this->image_back) {
            Yii::$app->image->deleteFile($this->image_back);
        }

        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'width' => 'Ширина',
            'height' => 'Высота',
            'text_front' => 'Текст лицевой стороны',
            'text_back' => 'Текст оборотной стороны',
            'image_front' => 'Изображение лицевой стороны',
            'image_back' => 'Изображение оборотной стороны',
            'imageFrontFile' => 'Изображение лицевой стороны',
            'imageBackFile' => 'Изображение оборотной стороны',
            'control_text' => 'Текст контрола',
            'control_text_back' => 'Текст контрола оборотной стороны',
            'capture_front' => 'Подпись лицевой стороны',
            'capture_back' => 'Подпись оборотной стороны',
        ];
    }
}