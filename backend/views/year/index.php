<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Годы';
$this->params['breadcrumbs'][] = $this->title;

$arr = [1 => 'Да', 0 => 'Нет'];
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить год', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'number',
                [
                    'attribute' => 'is_current',
                    'format' => 'raw',
                    'value' => function($data) use($arr) {
                        return $arr[$data->is_current];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'is_current', $arr, ['prompt'=>''])
                ],
                [
                    'attribute' => 'show_on_main',
                    'format' => 'raw',
                    'value' => function($data) use($arr) {
                        return $arr[$data->show_on_main];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'show_on_main', $arr, ['prompt'=>''])
                ],
                'title',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
