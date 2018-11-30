<?php

namespace common\models\blocks\items;

use Yii;
use yii\web\UploadedFile;

use common\models\blocks\BlockGallery;
/**
 * This is the model class for table "{{%block_gallery_image}}".
 *
 * @property integer $id
 * @property integer $block_gallery_id
 * @property string $image
 * @property string $title
 * @property string $copyright
 *
 * @property BlockGallery $blockGallery
 */
class BlockGalleryImage extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $imageNamePrefix;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_gallery_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'required', 'when' => function($model) {
                return $model->isNewRecord;
            }],
            [['block_gallery_id'], 'integer'],
            [['image', 'title', 'copyright'], 'string', 'max' => 255],
            [['block_gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockGallery::className(), 'targetAttribute' => ['block_gallery_id' => 'id']],
            [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
        ];
    }

    public function getImageInstance($galleryKey, $key) 
    {
        $this->imageFile = UploadedFile::getInstance($this, "[$galleryKey][$key]imageFile");
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->imageFile) {
            Yii::$app->image->updateImageAttribute($this, 'image', $this->imageFile);
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
        return [
            'id' => 'ID',
            'block_gallery_id' => 'Block Gallery ID',
            'image' => 'Изображение',
            'title' => 'Заголовок',
            'copyright' => 'Копирайт',
            'imageFile' => 'Изображение',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockGallery()
    {
        return $this->hasOne(BlockGallery::className(), ['id' => 'block_gallery_id']);
    }
}
