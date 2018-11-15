<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class EditorModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%editor_model}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['editor_id', 'model', 'model_id'], 'required'],
            [['editor_id', 'model_id'], 'integer'],
            [['model'], 'string'],
        ];
    }
}
