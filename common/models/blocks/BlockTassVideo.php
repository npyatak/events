<?php

namespace common\models\blocks;

use Yii;
use yii\web\UploadedFile;

class BlockTassVideo extends Block
{

    public $imageFile;
    public $imageCropParams = ['w' => 1820, 'h' => 1020, 'attribute' => 'image'];
    public $cropImage = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_tass_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['list_1'], 'required'],
                [['width', 'height'], 'integer'],
                [['title', 'image', 'list_1', 'list_2'], 'string', 'max' => 255],
                [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
        return 'Видео ТАСС';
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->imageFile = UploadedFile::getInstance($this, "[$this->key]imageFile");
        if($this->imageFile) {
            if(isset($this->cropImage['imageFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'image', $this->imageFile, $this->cropImage['imageFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'image', $this->imageFile);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {        
        if($this->image) {
            Yii::$app->image->deleteFile($this->image);
        }

        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'image' => 'Изображение для превью',
            'imageFile' => 'Изображение для превью',
            'list_1' => 'Ссылка на видеофайл в SD качестве',
            'list_2' => 'Ссылка на видеофайл в HD качестве',
            'width' => 'Ширина',
            'height' => 'Высота',
        ]);
    }
}