<?php
namespace common\fixtures;

use Yii;
use common\models\EventCategory;
use yii\test\ActiveFixture;

class EventCategoryFixture extends ActiveFixture
{
    public $modelClass = 'common\models\EventCategory';
    public $depends = ['common\fixtures\EventFixture'];
}