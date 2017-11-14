<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'События';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="district-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить событие', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                'view_date',

                [
                    'attribute' => 'timeline_date',
                    'value' => function($data) {
                        return date('m.Y', $data->timeline_date);
                    }
                ],
                [
                    'attribute' => 'socials_image_url',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::img($data->socials_image_url);
                    },
                ],
                'value_index',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
