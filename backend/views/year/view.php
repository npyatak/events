<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->number;
$this->params['breadcrumbs'][] = ['label' => 'Годы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$arr = [1 => 'Да', 0 => 'Нет'];
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['Изменить', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            [
                'attribute' => 'is_current',
                'format' => 'raw',
                'value' => function($data) use($arr) {
                    return $arr[$data->is_current];
                },
            ],
            [
                'attribute' => 'show_on_main',
                'format' => 'raw',
                'value' => function($data) use($arr) {
                    return $arr[$data->show_on_main];
                },
            ],
            'title',
            'leading_text:ntext',
            'logo_url',
            'main_page_image',
            'worked_on_project:ntext',
            'used_multimedia:ntext',
            'sources:ntext',
            'gratitude:ntext',
            'additional:ntext',
            'partner_text:ntext',
            'partner_url:ntext',
        ],
    ]) ?>

</div>
