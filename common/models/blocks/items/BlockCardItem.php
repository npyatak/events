<?php

namespace common\models\blocks\items;

use Yii;
use common\models\blocks\BlockCard;

class BlockCardItem extends \yii\db\ActiveRecord
{
    const ICON_QUESTION = 1;
    const ICON_INFO = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_card_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['block_card_id', 'icon'], 'integer'],
            [['title'], 'string', 'max' => 255],
            ['text', 'safe'],
            [['block_card_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlockCard::className(), 'targetAttribute' => ['block_card_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'block_card_id' => 'ID блока карточка',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'icon' => 'Иконка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockCard()
    {
        return $this->hasOne(BlockCard::className(), ['id' => 'block_card_id']);
    }

    public static function getIconsArray() {
        return [
            self::ICON_QUESTION => 'Иконка ?',
            self::ICON_INFO => 'Иконка i',
        ];
    }
}