<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\models\Admin;

$this->title = 'Поделиться';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить данные', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'month',
                [
                    'attribute' => 'year_id',
                    'value' => function($data) {
                        return $data->year->number;
                    }
                ],
                [
                    'attribute' => 'image',
                    'header' => 'Изображение на главной',
                    'format' => 'raw',
                    'value' => function($data) {
                        return $data->image ? Html::img(Yii::$app->image->getImageUrl($data->image), ['width' => '200']) : '';
                    },
                ],
                'title',
                'text',
                'twitter',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
