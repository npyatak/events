<?php

namespace common\models\blocks;

use Yii;

class BlockIframe extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_iframe}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['code'], 'required'],
                [['code'], 'safe'],
                ['title', 'string', 'max' => 255],
            ]
        );
    }

    public function getBlockName() {
        return 'IFrame';
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