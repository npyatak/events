<?php

namespace common\models\blocks;

use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\blocks\items\BlockGalleryImage;


class BlockGallery extends Block
{
    public $itemsToSave = [];
    public $itemsModelName = 'BlockGalleryImage';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_gallery}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['title'], 'string', 'max' => 255],
                ['itemsToSave', function($attribute, $params) {
                    if(count($this->itemsToSave) < 1) {
                        $this->addError($attribute, 'Необходимо добавить хотя бы один слайд');
                    } elseif(count($this->itemsToSave) > 20) {
                        $this->addError($attribute, 'Не более 20 слайдов');
                    } else {
                        foreach ($this->itemsToSave as $key => $item) {
                            $item->imageNamePrefix = $this->imageNamePrefix;
                            $item->getImageInstance($this->key, $key);
                            $item->validate();
                            if($item->hasErrors()) {
                                $this->addError($attribute, 'Необходимо заполнить все изображения');
                            }
                        }
                    }
                }],
            ]
        );
    }

    public static function getBlockName() {
        return 'Галерея';
    }

    public function afterSave($insert, $changedAttributes) {
        $imageIds = [];
        $oldImagesIds = BlockGalleryImage::find()->select('id')->where(['block_gallery_id' => $this->id])->column();
        foreach ($this->itemsToSave as $gI) {
            if($gI->id) {
                $imageIds[] = $gI->id;
            }
            $gI->block_gallery_id = $this->id;
            $gI->save();
        }

        foreach (array_diff($oldImagesIds, $imageIds) as $idToDel) {
            BlockGalleryImage::findOne($idToDel)->delete();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockGalleryImages()
    {
        return $this->hasMany(BlockGalleryImage::className(), ['block_gallery_id' => 'id']);
    }
}
