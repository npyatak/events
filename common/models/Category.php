<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property EventCategory[] $eventCategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title', 'url'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'url' => 'Адрес',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventCategories()
    {
        return $this->hasMany(EventCategory::className(), ['category_id' => 'id']);
    }
    
    public function getCategories()
    {
        return $this->hasMany(Event::className(), ['id' => 'event_id'])->viaTable(EventCategory::tableName(), ['category_id' => 'id']);
    }
}
