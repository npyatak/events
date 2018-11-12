<?php

namespace common\models\blocks;

use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\blocks\items\BlockCardItem;


class BlockCard extends Block
{
    public $itemsToSave = [];
    public $itemsModelName = 'BlockCardItem';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_card}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
                [['title'], 'string', 'max' => 255],
                ['itemsToSave', function($attribute, $params) {
                    if(count($this->itemsToSave) < 1) {
                        $this->addError($attribute, 'Необходимо добавить хотя бы один факт');
                    } else {
                        foreach ($this->itemsToSave as $item) {
                            $item->validate();
                            if($item->hasErrors()) {
                                $this->addError($attribute, 'Необходимо заполнить все факты');
                            }
                        }
                    }
                }],
            ]
        );
    }

    public static function getBlockName() {
        return 'Карточка';
    }

    public function afterSave($insert, $changedAttributes) {
        $itemsIds = [];
        $oldItemsIds = BlockCardItem::find()->select('id')->where(['block_card_id' => $this->id])->column();
        foreach ($this->itemsToSave as $gI) {
            if($gI->id) {
                $itemsIds[] = $gI->id;
            }
            $gI->block_card_id = $this->id;
            $gI->save();
        }

        foreach (array_diff($oldItemsIds, $itemsIds) as $idToDel) {
            BlockCardItem::findOne($idToDel)->delete();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'title' => 'Заголовок к верхнему разделителю',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockCardItems()
    {
        return $this->hasMany(BlockCardItem::className(), ['block_card_id' => 'id']);
    }
}
