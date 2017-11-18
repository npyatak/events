<?php

namespace common\models\blocks;

use Yii;

class BlockContent extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['text'], 'required'],
                [['text'], 'safe'],
            ]
        );
    }

    public function getBlockName() {
        return 'Контент';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
        ];
    }
}