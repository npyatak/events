<?php

namespace common\models\blocks;

use Yii;

class BlockImage extends Block
{
    public $imageFile;
    
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
                [['imageFile'], 'file', 'extensions'=>'jpg, png, jpeg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png'],
            ]
        );
    }

    public static function getBlockName() {
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