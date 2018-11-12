<?php

namespace common\models\blocks;

use Yii;

class BlockCode extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['code'], 'required'],
                [['code'], 'safe'],
            ]
        );
    }

    public static function getBlockName() {
        return 'HTML-код';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
        ];
    }
}