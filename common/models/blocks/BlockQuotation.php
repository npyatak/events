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
                [['text', 'author_name'], 'required'],
                [['text'], 'safe'],
                [['author_image', 'author_name', 'author_text'], 'string', 'max' => 255],
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
            'author_image' => 'Изображение автора',
            'author_name' => 'Имя автора',
            'author_text' => 'Подпись автора'
        ];
    }
}