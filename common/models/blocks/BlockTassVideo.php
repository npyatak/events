<?php

namespace common\models\blocks;

use Yii;

class BlockTassVideo extends Block
{

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_tass_video}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['list_1', 'list_2'], 'required'],
                [['title', 'image', 'list_1', 'list_2'], 'string', 'max' => 255],
            ]
        );
    }

    public function getBlockName() {
        return 'Видео ТАСС';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'image' => 'Изображение для превью',
            'list_1' => 'Плейлист 1',
            'list_2' => 'Плейлист 2',
        ]);
    }
}