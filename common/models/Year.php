<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class Year extends \yii\db\ActiveRecord
{
    public $mainPageImageFile;
    public $partnerImageIndexFile;
    public $partnerImageEventFile;
    public $cropImage = [];
    public $partnerImageIndexCropParams = ['w' => 360, 'h' => 600, 'attribute' => 'partner_image_index'];
    public $partnerImageEventCropParams = ['w' => 500, 'h' => 840, 'attribute' => 'partner_image_event'];

    public $imageNamePrefix;
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
            [['title', 'leading_text', 'logo_url', 'main_page_image', 'partner_url', 'partner_image_index', 'partner_image_event'], 'string', 'max' => 255],
            ['number', 'unique'],
            [['mainPageImageFile', 'partnerImageIndexFile', 'partnerImageEventFile'], 'file', 'extensions'=>'jpg, png, jpeg, svg', 'maxSize'=>1024 * 1024 * 10, 'mimeTypes' => 'image/jpg, image/jpeg, image/png, image/svg+xml'],
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
            'partner_text' => 'Текст меню бургера',
            'partner_url' => 'Ссылка',
            'partner_image_index' => 'Картинка баннера справа на главной',
            'partner_image_event' => 'Картинка баннера справа на событии',
            'mainPageImageFile' => 'Заглавное изображение', 
            'partnerImageIndexFile' => 'Изображение на главной',
            'partnerImageEventFile' => 'Изображение на странице события',
        ];
    }

    public function afterSave($insert, $changedAttributes) {
        if($this->is_current) {
            $otherYears = self::find()->where(['not', ['id' => $this->id]])->all();

            foreach ($otherYears as $y) {
                Yii::$app->db->createCommand()
                    ->update($y->tableSchema->name, ['is_current' => 0], 'id = "'.$y->id.'"')
                    ->execute();
            }
        }

        $this->imageNamePrefix = $this->id;

        $this->mainPageImageFile = UploadedFile::getInstance($this, 'mainPageImageFile');     
        if($this->mainPageImageFile) {
            Yii::$app->image->updateImageAttribute($this, 'main_page_image', $this->mainPageImageFile);
        }

        $this->cropImage = Yii::$app->request->post()['CropForm']['Year'];

        $this->partnerImageIndexFile = UploadedFile::getInstance($this, "partnerImageIndexFile");
        if($this->partnerImageIndexFile) {
            if(isset($this->cropImage['partnerImageIndexFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'partner_image_index', $this->partnerImageIndexFile, $this->cropImage['partnerImageIndexFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'partner_image_index', $this->partnerImageIndexFile);
            }
        }

        $this->partnerImageEventFile = UploadedFile::getInstance($this, "partnerImageEventFile");
        if($this->partnerImageEventFile) {
            if(isset($this->cropImage['partnerImageEventFile'])) {
                Yii::$app->image->updateImageAttribute($this, 'partner_image_event', $this->partnerImageEventFile, $this->cropImage['partnerImageEventFile']);
            } else {
                Yii::$app->image->updateImageAttribute($this, 'partner_image_event', $this->partnerImageEventFile);
            }
        }

        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShares()
    {
        return $this->hasMany(Share::className(), ['year_id' => 'id']);
    }

    public function getUrl()
    {        
        return Url::toRoute(['site/index', 'year' => $this->is_current ? null : $this->number]);
    }
}
