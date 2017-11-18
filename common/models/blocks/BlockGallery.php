<?php

namespace common\models\blocks;

use Yii;
use yii\helpers\ArrayHelper;

use yii\widgets\ActiveForm;

use common\models\Model;
use common\models\blocks\items\BlockGalleryImage;
/**
 * This is the model class for table "{{%block_gallery}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property BlockGalleryImage[] $blockGalleryImages
 */
class BlockGallery extends Block
{
    public $imageArray = [];
    public $galleryImageModelsToSave = [];
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
                ['galleryImageModelsToSave', function($attribute, $params) {
                    if(count($this->galleryImageModelsToSave) < 1) {
                        $this->addError($attribute, 'Необходимо добавить хотя бы один слайд');
                    } elseif(count($this->galleryImageModelsToSave) > 20) {
                        $this->addError($attribute, 'Не более 20 слайдов');
                    } else {
                        foreach ($this->galleryImageModelsToSave as $im) {
                            $im->validate();
                            if($im->hasErrors()) {
                                $this->addError($attribute, 'Необходимо заполнить все изображения');
                            }
                        }
                    }
                }],
            ]
        );
    }

    public function getBlockName() {
        return 'Галерея';
    }

    public function afterSave($insert, $changedAttributes) {
        $imageIds = [];
        $oldImagesIds = BlockGalleryImage::find()->select('id')->where(['block_gallery_id' => $this->id])->column();
        foreach ($this->galleryImageModelsToSave as $gI) {
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

    public function loadNewGalleryImageModels($newModels) {
        foreach ($newModels as $model) {
            if(isset($model['id']) && $model['id']) {
                $imageModel = BlockGalleryImage::findOne($model['id']);
            } else {
                $imageModel = new BlockGalleryImage;
            }
            $imageModel->load($model);
            $imageModel->attributes = $model;
            $this->galleryImageModelsToSave[] = $imageModel;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockGalleryImages()
    {
        return $this->hasMany(BlockGalleryImage::className(), ['block_gallery_id' => 'id']);
    }
}
