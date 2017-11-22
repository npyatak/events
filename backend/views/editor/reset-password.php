<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сменить пароль - '.$model->login;
$this->params['breadcrumbs'][] = ['label' => 'Редакторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->login;
?>

<div class="add-form">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="add-form-buttons">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>