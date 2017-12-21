<?php

namespace common\models\blocks;

use Yii;

class BlockFlipCard extends Block
{
    const DEFAULT_WIDTH = 660;
    const DEFAULT_HEIGHT = 400;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_flip_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['image_front', 'image_back', 'control_text', 'capture_front', 'control_text_back', 'capture_back'], 'string', 'max' => 255],
                [['width', 'height'], 'integer', 'max' => 9999],
                [['text_front', 'text_back'], 'safe'],
            ]
        );
    }

    public function getBlockName() {
        return 'Флип-карта';
    }

    public function beforeSave($insert) {
        if(!$this->width) {
            $this->width = self::DEFAULT_WIDTH;
        }
        if(!$this->height) {
            $this->height = self::DEFAULT_HEIGHT;
        }

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'width' => 'Ширина',
            'height' => 'Высота',
            'text_front' => 'Текст лицевой стороны',
            'text_back' => 'Текст оборотной стороны',
            'image_front' => 'Изображение лицевой стороны',
            'image_back' => 'Изображение оборотной стороны',
            'control_text' => 'Текст контрола',
            'control_text_back' => 'Текст контрола оборотной стороны',
            'capture_front' => 'Подпись лицевой стороны',
            'capture_back' => 'Подпись оборотной стороны',
        ];
    }
}