<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\assets\UIAsset;

UIAsset::register($this);

use common\models\Event;

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
                    'attribute' => 'main_page_image_url',
                    'header' => 'Изображение на главной',
                    'format' => 'raw',
                    'value' => function($data) {
                        return $data->main_page_image_url ? Html::img($data->getImageUrl($data->main_page_image_url, '200x200')) : '';
                    },
                ],
                
                [
                    'attribute' => 'value_index',
                    'filter' => Html::activeDropDownList($searchModel, 'value_index', Event::getValueIndexArray(), ['prompt'=>'']),
                ],
                [
                    'attribute' => 'status',
                    'format' => 'raw',
                    'value' => function($data) {
                        return $data->getStatusArray()[$data->status];
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'status', Event::getStatusArray(), ['prompt'=>''])
                ],
                [
                    'header' => 'Блоки (можно менять порядок)',
                    'format' => 'raw',
                    'value' => function($data) {
                        $blockList = Event::getBlocksList();
                        $str = '<ul class="sortable">';
                        if($data->eventBlocks) {
                            foreach ($data->eventBlocks as $eb) {
                                $str .= '<li>'
                                    .$blockList[$eb->modelPath.$eb->model]
                                    .Html::activeHiddenInput($eb, "[$eb->id]order", ['class' => 'hidden-order'])
                                .'</li>';
                            }
                        }
                        $str .= '</ul>';

                        return $str;
                    }
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {blocks} {delete}',                    
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->url, [
                                'title' => 'Просмотр'
                            ]);
                        },
                        'blocks' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-th-large"></span>', $url, [
                                'title' => 'Редактировать блоки'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php $script = "
    $('.sortable').sortable({
        cursor: 'move',
        classes: {
            'ui-sortable': 'highlight'
        },
        update: function(event, ui) {
            updateBlocksOrder(ui);
        },
    });

    function updateBlocksOrder(ui) {
        var ul = ui.item.closest('ul');
        
        ul.find('li').each(function() {
            var order = $(this).index() + 1;
            $(this).find('.hidden-order').val(order);
        });

        $.ajax({
            type: 'POST',
            url: '".Url::toRoute('/event/order')."',
            data: ul.find('input').serialize(),
            success: function (data) {

            }
        });
    }
";

$this->registerJs($script, yii\web\View::POS_END);?>