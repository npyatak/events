<?php

namespace common\models;

use Yii;

use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\components\ThumbnailImage;
use common\helpers\TransliteratorHelper;

class Event extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 5;
    const STATUS_INACTIVE = 0;

    const DATE_TYPE_DATE = 1;
    const DATE_TYPE_MONTH_AND_YEAR = 2;
    const DATE_TYPE_SEASON_AND_YEAR = 3;
    const DATE_UNKNOWN = 4;

    const SIZE_SMALL = 1;
    const SIZE_MEDIUM = 2;
    const SIZE_LARGE = 3;

    public $categoryIds = [];
    public $similarIds = [];
    public $dateFormatted;
    public $imageDir = 'event';
    public $month;
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
            [['title', 'size'], 'required'],
            [['view_date_type', 'dateFormatted', 'alias'], 'required'],
            [['show_on_main', 'value_index', 'status', 'created_at', 'updated_at', 'view_date_type', 'size', 'date'], 'integer'],
            [['title', 'leading_text', 'socials_image_url', 'image_url', 'main_page_image_url', 'socials_text', 'image_copyright', 'socials_title', 'alias', 'twitter_text', 'mobile_image_url', 'small_image_url', 'short_title', 'meta_title', 'meta_description', 'redirect_url'], 'string', 'max' => 255],
            [['categoryIds', 'similarIds', 'copyright'], 'safe'],
            [['alias'], 'unique'],
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
            'short_title' => 'Короткий заголовок',
            'leading_text' => 'Лид',
            'viewDate' => 'Отображаемая дата',
            'date' => 'Дата',
            'view_date_type' => 'Тип даты',
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
            'dateFormatted' => 'Дата',
            'size' => 'Размер карточки',
            'twitter_text' => 'Текст для Twitter',
            'alias' => 'Алиас',
            'mobile_image_url' => 'Изображение для мобильных',
            'small_image_url' => 'Маленькое изображение',
            'copyright' => 'Копирайты',
            'meta_title' => 'META title',
            'meta_description' => 'META description',
            'redirect_url' => 'URL редиректа'
        ];
    }

    public function beforeSave($insert) {
        if($this->dateFormatted) {
            $this->date = \DateTime::createFromFormat('!d.m.Y', $this->dateFormatted)->format('U');
        }
        $this->similar = json_encode($this->similarIds);

        if(!$this->alias) {
            $this->alias = TransliteratorHelper::process($this->title);
        }

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
        $this->dateFormatted = date('d.m.Y', $this->date);
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
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable(EventCategory::tableName(), ['event_id' => 'id']);
    }

    public static function getValueIndexArray() {
        $res = [];
        for ($i=1; $i <= 10 ; $i++) { 
            $res[$i] = $i;
        }

        return $res;
    }

    public static function getStatusArray() {
        return [
            self::STATUS_INACTIVE => 'Неактивно',
            self::STATUS_ACTIVE => 'Активно',
        ];
    }

    public static function getBlocksArray() {
        return [
            '\common\models\blocks\BlockContent',
            '\common\models\blocks\BlockQuotation',
            '\common\models\blocks\BlockImage',
            '\common\models\blocks\BlockGallery',
            '\common\models\blocks\BlockFact',
            '\common\models\blocks\BlockCard',
            '\common\models\blocks\BlockFlipCard',
            '\common\models\blocks\BlockMap',
            '\common\models\blocks\BlockTassVideo',
            '\common\models\blocks\BlockIframe',
            '\common\models\blocks\BlockCode',
            '\common\models\blocks\BlockCut',
            '\common\models\blocks\BlockCutEnd',
        ];
    }

    public static function getBlocksList() {
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
            self::DATE_TYPE_DATE => 'Число и месяц',
            self::DATE_TYPE_MONTH_AND_YEAR => 'Месяц и год',
            self::DATE_TYPE_SEASON_AND_YEAR => 'Сезон и год',
            self::DATE_UNKNOWN => 'Без точной даты',
        ];
    }

    public static function getSizeArray() {
        return [
            self::SIZE_SMALL => 'Маленькая',
            self::SIZE_MEDIUM => 'Средняя',
            self::SIZE_LARGE => 'Большая',
        ];
    }

    public function getUrl($absolute = false) {
        if($this->redirect_url) {
            return $this->redirect_url;
        }

        $dateTime = new \DateTime;
        $dateTime->setTimestamp($this->date);
        $year = $dateTime->format('Y');

        if($absolute) {
            Yii::$app->urlManagerFrontEnd->createAbsoluteUrl(['/site/event', 'alias' => $this->alias, 'year' => $year]);
        } else {
            return Yii::$app->urlManagerFrontEnd->createUrl(['/site/event', 'alias' => $this->alias, 'year' => $year]);
        }
    }

    public function getNoFollow() {
        if($this->redirect_url) {
            if(substr_count($this->redirect_url, 'tass.ru') == 0) {
                return 'rel=nofollow';
            }
        }
    }

    public function getImageSrcPath() {
        return __DIR__ . '/../../frontend/web';
    }

    public function getImageUrl($image, $thumb_size = false) {
        if(isset(Yii::$app->webdavFs)) {
            $parse = parse_url($image);
            if(isset($parse['scheme'])) {
                return $image;
            } else {
                return Yii::$app->webdavFs->baseUri.$image;
            }
        } else if(is_file($this->imageSrcPath.$image)) {
            return Url::to($image);
        } else {
            return ThumbnailImage::getExternalImageUrl($image, $thumb_size, 'event');
        }
    }

    public function getViewDate() {
        $date = [];
        $dateTime = new \DateTime;
        $dateTime->setTimestamp($this->date);
        $monthId = $dateTime->format('n');
        switch ($this->view_date_type) {
            case self::DATE_TYPE_DATE:
                $date = [$dateTime->format('j'), $this->getMonth($monthId, true)];
                break;
            case self::DATE_TYPE_MONTH_AND_YEAR:
                $date = [$this->getMonth($monthId), $dateTime->format('Y')];
                break;
            case self::DATE_TYPE_SEASON_AND_YEAR:
                $date = [$this->season, $dateTime->format('Y')];
                break;
            case self::DATE_UNKNOWN:
                $date = ['без точной даты', null];
                break;
        }

        return $date;
    }

    public function getSeason() {
        $seasonsMonths = ['01' => 1, '02' => 1, '03' => 2, '04' => 2, '05' => 2, '06' => 3, '07' => 3, '08' => 3, '09' => 4, '10' => 4, '11' => 4, '12' => 1];
        
        return $this->seasonsArray[$seasonsMonths[date('m', $this->date)]];
    }

    public static function getSeasonsArray() {
        return [
            1 => 'зима',
            2 => 'весна',
            3 => 'лето',
            4 => 'осень',
        ];
    }

    public function getMonth($monthId, $secondForm=false) {
        return $secondForm ? self::getMonthsArray()[$monthId][1] : self::getMonthsArray()[$monthId][0];
    }

    public static function getMonthsArray() {
        return [
            1 => ['январь', 'января'],
            2 => ['февраль', 'февраля'],
            3 => ['март', 'марта'],
            4 => ['апрель', 'апреля'],
            5 => ['май', 'мая'],
            6 => ['июнь', 'июня'],
            7 => ['июль', 'июля'],
            8 => ['август', 'августа'],
            9 => ['сентябрь', 'сентября'],
            10 => ['октябрь', 'октября'],
            11 => ['ноябрь', 'ноября'],
            12 => ['декабрь', 'декабря'],
        ];
    }

    public function getSimilarEvents() {
        return self::find()->where(['in', 'id', $this->similarIds])->orderBy('date')->all();
    }
}
