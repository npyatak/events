<?php

namespace common\models\blocks\items;

use Yii;
use common\models\blocks\BlockFact;


class BlockFactItem extends \yii\db\ActiveRecord
{
    const TYPE_TOP = 1;
    const TYPE_SIDE = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_fact_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'capture', 'type'], 'required'],
            [['block_fact_id', 'type', 'border_top', 'border_bottom'], 'integer'],
            [['number', 'capture', 'link'], 'string', 'max' => 255],
            ['text', 'safe'],
            [['block_fact_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockFact::className(), 'targetAttribute' => ['block_fact_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'block_fact_id' => 'ID блока фактов',
            'number' => 'Число',
            'capture' => 'Подпись',
            'link' => 'Текст ссылки для разворачивания',
            'text' => 'Текст под катом',
            'type' => 'Тип',
            'border_top' => 'Граница сверху',
            'border_bottom' => 'Граница снизу',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockFact()
    {
        return $this->hasOne(BlockFact::className(), ['id' => 'block_fact_id']);
    }

    public static function getTypesArray() {
        return [
            self::TYPE_TOP => 'Число сбоку',
            self::TYPE_SIDE => 'Число сверху',
        ];
    }
}
