<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%event_block}}".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $model
 * @property integer $block_id
 * @property integer $order
 * @property string $anchor
 */
class EventBlock extends \yii\db\ActiveRecord
{

    public $_block;
    
    public $key;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event_block}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'model', 'block_id'], 'required'],
            [['event_id', 'block_id', 'order'], 'integer'],
            [['model'], 'string', 'max' => 100],
            [['anchor'], 'string', 'max' => 20],
        ];
    }

    public function afterDelete() {
        if($this->block !== null) {
            $this->block->delete();
        }

        return parent::afterDelete();
    }

    // public function afterFind() {
    //     $this->block->order = $this->order;
    //     $this->block->anchor = $this->anchor;
    // }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'model' => 'Model',
            'block_id' => 'Block ID',
            'order' => 'Order',
            'anchor' => 'Anchor',
        ];
    }

    public function getModelPath() {
        return '\common\models\blocks\\';
    }

    public function getBlock() {
        if(!$this->_block) {
            $model = $this->modelPath.$this->model;
            $this->_block = $model::findOne($this->block_id);
        }

        return $this->_block;
    }

    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
