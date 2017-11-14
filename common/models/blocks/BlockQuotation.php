<?php

namespace common\models\blocks;

use Yii;

class BlockQuotation extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_quotation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['text'], 'required'],
                [['text'], 'safe'],
                [['by_line'], 'string'],
            ]
        );
    }

    public function getBlockName() {
        return 'Цитата';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'by_line' => 'Подпись'
        ];
    }

    public function getFloatArray() {
        return [
            'left',
            'right',
            'center',
        ];
    }
}