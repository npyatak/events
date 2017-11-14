<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $leading_text
 * @property string $view_date
 * @property string $timeline_date
 * @property string $socials_image_url
 * @property string $image_url
 * @property string $socials_text
 * @property integer $show_on_main
 * @property integer $value_index
 * @property string $similar
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property EventCategory[] $eventCategories
 */
class Event extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;

    public $categoryIds = [];
    public $similarIds = [];
    public $timelineDateFormatted;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'socials_image_url', 'image_url', 'timelineDateFormatted'], 'required'],
            [['show_on_main', 'value_index', 'status', 'timeline_date', 'created_at', 'updated_at'], 'integer'],
            [['title', 'leading_text', 'socials_image_url', 'image_url', 'socials_text'], 'string', 'max' => 255],
            [['view_date'], 'string', 'max' => 100],
            [['categoryIds', 'similarIds', 'content'], 'safe']
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
            'leading_text' => 'Лид',
            'view_date' => 'Отображаемая дата',
            'timeline_date' => 'Дата привязки к таймлайн',
            'socials_image_url' => 'Ссылка на изображение для карточки на главной',
            'image_url' => 'Ссылка на заглавное изображение',
            'socials_text' => 'Текст для соцсетей',
            'show_on_main' => 'Показать на главной',
            'value_index' => 'Индекс значимости',
            'similar' => 'Связанные события',
            'status' => 'Статус',
            'categories' => 'Категории',
            'content' => 'Контент',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
        ];
    }

    public function beforeSave($insert) {
        $this->timeline_date = \DateTime::createFromFormat('m.Y', $this->timelineDateFormatted)->format('U');
        $this->similar = json_encode($this->similarIds);

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes) {
        $categoryIds = $this->categoryIds ? $this->categoryIds : [];
        $oldCategoriesIds = EventCategory::find()->select(['category_id'])->where(['event_id' => $this->id])->column();
        $idsToDelete = array_diff($oldCategoriesIds, $categoryIds);
        EventCategory::deleteAll(['category_id' => $idsToDelete, 'event_id' => $this->id]);

        foreach ($categoryIds as $category_id) {
            if(!in_array($category_id, $oldCategoriesIds)) {
                $eventCategory = new EventCategory;
                $eventCategory->event_id = $this->id;
                $eventCategory->category_id = $category_id;

                $eventCategory->save();
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind() {
        $this->timelineDateFormatted = date('m.Y', $this->timeline_date);
        $this->categoryIds = EventCategory::find()->select(['category_id'])->where(['event_id' => $this->id])->column();
        $this->similarIds = json_decode($this->similar);
    }

    public function getEventBlocks()
    {
        return $this->hasMany(EventBlock::className(), ['event_id' => 'id'])->orderBy('order');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventCategories()
    {
        return $this->hasMany(EventCategory::className(), ['event_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable(EventCategory::tableName(), ['event_id' => 'id'])->all();
    }

    public function getValueIndexArray() {
        $res = [];
        for ($i=1; $i <= 10 ; $i++) { 
            $res[$i] = $i;
        }

        return $res;
    }

    public function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивно',
            self::STATUS_ACTIVE => 'Активно',
        ];
    }

    public function getBlocksArray() {
        return [
            'common\models\blocks\BlockQuotation' => \common\models\blocks\BlockQuotation::getBlockName(),//'Цитата',
            'common\models\blocks\BlockImage' => \common\models\blocks\BlockImage::getBlockName(),
        ];
    }

    public function getArrayForSimilar() {
        $query = self::find()->select(['id', 'title']);
        if($this->id) {
            $query->andWhere(['not', ['id' => $this->id]]);
        }
        return ArrayHelper::map($query->asArray()->all(), 'id', 'title');
    }
}
