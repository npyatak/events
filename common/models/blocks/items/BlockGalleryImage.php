<?php

namespace common\models\blocks\items;

use Yii;
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
            [['image'], 'required'],
            [['block_gallery_id'], 'integer'],
            [['image', 'title', 'copyright'], 'string', 'max' => 255],
            [['block_gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockGallery::className(), 'targetAttribute' => ['block_gallery_id' => 'id']],
        ];
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
