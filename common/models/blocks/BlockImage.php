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
                [['source', 'url'], 'required'],
                [['show_fullscreen'], 'integer'],
                [['source', 'url', 'copyright_text', 'text'], 'string', 'max' => 255],
                ['copyright_color', 'string', 'max' => 7],
                [['float'], 'string', 'max' => 10],
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
        return [
            'id' => 'ID',
            'source' => 'Источник',
            'float' => 'Выравнивание',
            'url' => 'Ссылка',
            'show_fullscreen' => 'На весь экран',
            'copyright_text' => 'Текст копирайта',
            'copyright_color' => 'Цвет текста копирайта',
            'text' => 'Текст',
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