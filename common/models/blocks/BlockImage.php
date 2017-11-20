<?php

namespace common\models\blocks;

use Yii;

class BlockImage extends Block
{
    //public $blockName = 'Изображение';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), 
            [
                [['source'], 'required'],
                [['show_fullscreen'], 'integer'],
                [['source', 'copyright_text', 'text'], 'string', 'max' => 255],
            ]
        );
    }

    public function getBlockName() {
        return 'Изображение';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
                'source' => 'Источник',
                'show_fullscreen' => 'На весь экран',
                'copyright_text' => 'Текст копирайта',
                'text' => 'Сопровождающий текст',
            ]
        );
    }
}