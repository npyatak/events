<?php

namespace common\models\blocks;

use Yii;

class BlockMap extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['code'], 'required'],
                [['code'], 'safe'],
                ['caption', 'string', 'max' => 255],
            ]
        );
    }

    public function getBlockName() {
        return 'Карта';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'caption' => 'Подпись',
        ];
    }
}