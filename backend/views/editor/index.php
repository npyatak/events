<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\models\Admin;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'login',
                [
                    'attribute' => 'role',
                    'value' => function($data) {
                        return $data->roleLabel;
                    },
                    'filter' => Html::activeDropDownList($searchModel, 'role', Admin::getRolesArray(), ['prompt'=>'']),
                ],
                'email:email',
                'name',
                'surname',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete} {reset-password}',
                    'buttons' => [
                        'reset-password' => function ($url, $model) {
                            $url = Url::toRoute(['/admin/reset-password', 'id'=>$model->id]);
                            return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, [
                                'title' => 'Сменить пароль'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
</div>
