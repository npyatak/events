<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

class Settings extends \yii\db\ActiveRecord
{
    const TYPE_FOOTER = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['key', 'title'], 'string', 'max' => 100],
            [['value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'value' => 'Значение',
            'title' => 'Заголовок',
        ];
    }

    public function getSettings() {
        $settings = static::find()->asArray()->all();
        return ArrayHelper::map($settings, 'key', 'value');
    }

    public function setSetting($key, $value) {
        $model = static::findOne(['key' => $key]);
        if ($model === null) {
            $model = new static();
        }
        $model->key = $key;
        $model->value = strval($value);

        return $model->save();
    }

    public function findSetting($key) {
        return $this->find()->where(['key' => $key])->one();
    }
}
