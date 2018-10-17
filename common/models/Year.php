<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%year}}".
 *
 * @property integer $id
 * @property integer $number
 * @property integer $is_current
 * @property integer $show_on_main
 * @property string $title
 * @property string $leading_text
 * @property string $logo_url
 * @property string $main_page_image
 * @property string $worked_on_project
 * @property string $used_multimedia
 * @property string $sources
 * @property string $gratitude
 * @property string $additional
 * @property string $partner_text
 * @property string $partner_url
 *
 * @property Share[] $shares
 */
class Year extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%year}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'title'], 'required'],
            [['number', 'is_current', 'show_on_main'], 'integer'],
            [['worked_on_project', 'used_multimedia', 'sources', 'gratitude', 'additional', 'partner_text'], 'string'],
            [['title', 'leading_text', 'logo_url', 'main_page_image', 'partner_url'], 'string', 'max' => 255],
            ['number', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Год',
            'is_current' => 'Текущий',
            'show_on_main' => 'Показать на главной',
            'title' => 'Заголовок проекта',
            'leading_text' => 'Текст преамбулы',
            'logo_url' => 'Ссылка с логотипа',
            'main_page_image' => 'Заглавное изображение',
            'worked_on_project' => 'Перечень работавших над проектом',
            'used_multimedia' => 'В материале использованы фотографии/видео',
            'sources' => 'Источники',
            'gratitude' => 'Блок благодарностей экспертам и организациям',
            'additional' => 'Дополнительный текстовый блок',
            'partner_text' => 'Текст партнера для правой колонки на главной',
            'partner_url' => 'Ссылка с текста партнера на главной',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['year_id' => 'id']);
    }
}
