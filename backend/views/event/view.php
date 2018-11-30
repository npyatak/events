<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Event;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'title',
            'alias',
            [
                'attribute' => 'viewDate',
                'value' => function($data) {
                    return implode(' ', $data->viewDate);
                }
            ],
            [
                'attribute' => 'date',
                'value' => function($data) {
                    return $data->dateFormatted;
                }
            ],
            [
                'attribute' => 'main_page_image_url',
                'header' => 'Изображение на главной',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->main_page_image_url ? Html::img($data->getImageUrl($data->main_page_image_url, '200x200'), ['width' => '200']) : '';
                },
            ],
            'value_index',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getStatusArray()[$data->status];
                },
            ],
            [
                'attribute' => 'size',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getSizeArray()[$data->size];
                },
            ],
            [
                'attribute' => 'eventBlocks',
                'header' => 'Блоки',
                'format' => 'raw',
                'value' => function($data) {
                    $blockList = Event::getBlocksList();
                    $str = '<ul class="">';
                    if($data->eventBlocks) {
                        foreach ($data->eventBlocks as $eb) {
                            $str .= '<li>'
                                .$blockList[$eb->modelPath.$eb->model]
                            .'</li>';
                        }
                    }
                    $str .= '</ul>';

                    return $str;
                }
            ],
            
        ],
    ]) ?>

</div>
