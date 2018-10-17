<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use common\models\Settings;

$this->title = 'Настройки';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'key',
                'title',
                [
                    'attribute' => 'value',
                    'value' => function($data) {
                        return $data->type == Settings::TYPE_CHECKBOX_LIST ? implode('<br>', $data->value) : $data->value;
                    },
                    'format' => 'raw',
                    'contentOptions' => [
                        'style' => 'max-width: 300px; overflow: hidden;'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}',
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
