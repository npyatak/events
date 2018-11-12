<?php

namespace common\models\blocks;

use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\blocks\items\BlockFactItem;


class BlockFact extends Block
{
    public $itemsToSave = [];
    public $itemsModelName = 'BlockFactItem';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_fact}}';
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
        return 'Цифрофакт';
    }

    public function afterSave($insert, $changedAttributes) {
        $itemsIds = [];
        $oldItemsIds = BlockFactItem::find()->select('id')->where(['block_fact_id' => $this->id])->column();
        foreach ($this->itemsToSave as $gI) {
            if($gI->id) {
                $itemsIds[] = $gI->id;
            }
            $gI->block_fact_id = $this->id;
            $gI->save();
        }

        foreach (array_diff($oldItemsIds, $itemsIds) as $idToDel) {
            BlockFactItem::findOne($idToDel)->delete();
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function attributeLabels() {
        return array_merge(parent::attributeLabels(), [
            'title' => 'Заголовок для серой отсечки',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlockFactItems()
    {
        return $this->hasMany(BlockFactItem::className(), ['block_fact_id' => 'id']);
    }
}
