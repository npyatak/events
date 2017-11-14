<?php

namespace common\models\blocks;

use Yii;
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

    public function afterFind() {
        $this->order = $this->eventBlock->order;
        $this->anchor = $this->eventBlock->anchor;
    }

    public function afterDelete() {
        if($this->eventBlock !== null) {
            $this->eventBlock->delete();
        }

        return parent::afterDelete();
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
            'text' => 'Текст',
            'by_line' => 'Подпись'
        ];
    }
}