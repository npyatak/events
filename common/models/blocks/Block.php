<?php

namespace common\models\blocks;

use Yii;
use common\components\ThumbnailImage;

use common\models\EventBlock;

class Block extends \yii\db\ActiveRecord
{
    public $order;
    public $anchor;

    public function rules()
    {
        return [
            [['order'], 'required'],
            [['order'], 'integer'],
            [['anchor'], 'string'],
        ];
    }

    public function afterDelete() {
        if($this->eventBlock !== null) {
            $this->eventBlock->delete();
        }

        return parent::afterDelete();
    }

    public function loadItems($newModels) {
        foreach ($newModels as $model) {
            if(isset($model['id']) && $model['id']) {
                $itemModel = $this->itemsModelFullName::findOne($model['id']);
            } else {
                $itemModel = new $this->itemsModelFullName;
            }
            $itemModel->load($model);
            $itemModel->attributes = $model;
            $this->itemsToSave[] = $itemModel;
        }
    }

    public function getItemsModelFullName() {
        return '\common\models\blocks\items\\'.$this->itemsModelName;
    }

    public function getEventBlock() {
        return EventBlock::find()->where(['model' => $this->formName(), 'block_id' => $this->id])->one();
    }

    public function getView() {
        return $this->tableSchema->name;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
        ];
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../../frontend/web';
    }

    public function getImageUrl($image, $thumb_size = false) {
        if(is_file($this->imageSrcPath.$image)) {
            return $image;
        } else {
            return ThumbnailImage::getExternalImageUrl($image, $thumb_size, 'event');
        }
    }
}