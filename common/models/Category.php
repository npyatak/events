<?php

namespace common\models;

use Yii;

use yii\helpers\Url;
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
            [['title', 'alias'], 'string', 'max' => 100],
            ['color', 'string', 'max' => 7],
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
            'alias' => 'Алиас',
            'color' => 'Цвет',
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

    public function getUrl() {
        return Url::toRoute(['site/index', 'category' => $this->alias]);
    }
}
