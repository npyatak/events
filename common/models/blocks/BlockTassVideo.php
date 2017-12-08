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
                [['list_1'], 'required'],
                [['width', 'height'], 'integer'],
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
            'list_1' => 'Ссылка на видеофайл в SD качестве',
            'list_2' => 'Ссылка на видеофайл в HD качестве',
            'width' => 'Ширина',
            'height' => 'Высота',
        ]);
    }
}