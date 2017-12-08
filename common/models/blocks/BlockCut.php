<?php

namespace common\models\blocks;

use Yii;

class BlockCut extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_cut}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['title', 'preview', 'text'], 'required'],
                [['title', 'preview', 'text_show', 'text_hide'], 'string', 'max' => 255],
                [['text'], 'safe'],
            ]
        );
    }

    public function getBlockName() {
        return 'Кат';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
                'preview' => 'Превью',
                'text_show' => 'Текст контрола для разворачивания',
                'text_hide' => 'Текст контрола для сворачивания',
            ]    
        );
    }
}