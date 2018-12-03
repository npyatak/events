<?php

namespace common\models\blocks;

use Yii;
use yii\web\UploadedFile;

class BlockQuotation extends Block
{
    public $authorImageFile;
    public $authorImageCropParams = ['w' => 144, 'h' => 144, 'attribute' => 'author_image'];
    public $cropImage = [];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_quotation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['text'], 'required'],
                [['text'], 'safe'],
                [['author_image', 'author_name', 'author_text'], 'string', 'max' => 255],
                [['authorImageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
        return 'Цитата';
    }

    public function afterSave($insert, $changedAttributes)
    {
        //$this->authorImageFile = UploadedFile::getInstanceByName($this->cropImage['postPath']."[author_image][imageFile]");
        $this->authorImageFile = UploadedFile::getInstance($this, "[$this->key]authorImageFile");
        
        if($this->authorImageFile) {
            if(isset($this->cropImage['authorImageFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'author_image', $this->authorImageFile, $this->cropImage['authorImageFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'author_image', $this->authorImageFile);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete() {        
        if($this->author_image) {
            Yii::$app->image->deleteFile($this->author_image);
        }

        return parent::afterDelete();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
                'author_image' => 'Изображение автора',
                'authorImageFile' => 'Изображение автора',
                'author_name' => 'Имя автора',
                'author_text' => 'Подпись автора'
            ]
        );
    }
}