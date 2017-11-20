<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\components\ThumbnailImage;

class Event extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;

    const DATE_TYPE_DATE = 1;
    const DATE_TYPE_MONTH_AND_YEAR = 2;
    const DATE_TYPE_SEASON_AND_YEAR = 3;

    public $categoryIds = [];
    public $similarIds = [];
    public $timelineDateFormatted;
    public $imageDir = 'event';
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
            [['title', 'timelineDateFormatted', 'view_date_type'], 'required'],
            [['show_on_main', 'value_index', 'status', 'timeline_date', 'created_at', 'updated_at', 'view_date_type'], 'integer'],
            [['title', 'leading_text', 'socials_image_url', 'image_url', 'main_page_image_url', 'socials_text', 'image_copyright', 'socials_title'], 'string', 'max' => 255],
            [['view_date'], 'string', 'max' => 100],
            [['categoryIds', 'similarIds'], 'safe']
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
            'view_date_type' => 'Тип даты',
            'timeline_date' => 'Дата привязки к таймлайн',
            'socials_image_url' => 'Ссылка на изображение для соц.сетей',
            'image_url' => 'Ссылка на заглавное изображение',
            'main_page_image_url' => 'Ссылка на изображение для карточки на главной',
            'image_copyright' => 'Копирайт к заглавной фотографии',
            'socials_text' => 'Текст для соц.сетей',
            'socials_title' => 'Заголовок для соц.сетей',
            'show_on_main' => 'Показать на главной',
            'value_index' => 'Индекс значимости',
            'similar' => 'Связанные события',
            'status' => 'Статус',
            'categories' => 'Категории',
            'content' => 'Контент',
            'created_at' => 'Дата/Время создания',
            'updated_at' => 'Время последнего изменения',
            'categoryIds' => 'Категории',
            'similarIds' => 'Связанные события',
            'timelineDateFormatted' => 'Дата привязки к таймлайн',
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
            'common\models\blocks\BlockContent',
            'common\models\blocks\BlockQuotation',
            'common\models\blocks\BlockImage',
            'common\models\blocks\BlockGallery',
            'common\models\blocks\BlockFact',
            'common\models\blocks\BlockCut',
            'common\models\blocks\BlockMap',
            'common\models\blocks\BlockIframe',
            'common\models\blocks\BlockCode',
        ];
    }

    public function getBlocksList() {
        $res = [];
        foreach (self::getBlocksArray() as $block) {
            $res[$block] = $block::getBlockName();
        }

        return $res;
    }

    public function getArrayForSimilar() {
        $query = self::find()->select(['id', 'title']);
        if($this->id) {
            $query->andWhere(['not', ['id' => $this->id]]);
        }
        return ArrayHelper::map($query->asArray()->all(), 'id', 'title');
    }

    public function getDateTypeList() {
        return [
            self::DATE_TYPE_DATE => 'Дата',
            self::DATE_TYPE_MONTH_AND_YEAR => 'Месяц и год',
            self::DATE_TYPE_SEASON_AND_YEAR => 'Сезон и год',
        ];
    }

    public function getImageUrl($thumb_size=false, $image=false, $imageDir=false) {
        if(!$image) $image = $this->image;
        if(!$imageDir) $imageDir = $this->imageDir;
        if($thumb_size) {
            if(!$image) {
                $image = __DIR__ . '/../../frontend/web/images/no_image.png';
                $url = '/images/no_image.png';
                $dir = false;
            }
            $file_headers = @get_headers($file);
            if($file_headers && $file_headers[0] != 'HTTP/1.1 404 Not Found') {
                $sizes = explode('x', $thumb_size);
                $imageSrc = ThumbnailImage::thumbnailFileUrl(
                    $image,
                    $sizes[0],
                    $sizes[1],
                    ThumbnailImage::THUMBNAIL_INSET,
                    $imageDir
                );
                return $imageSrc;
            }
        } else {
            return $this->image;
        }
    }
}
