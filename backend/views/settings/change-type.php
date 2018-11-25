<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Settings;

$this->title = 'Изменить настройку: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <h1><?= Html::encode($this->title) ?></h1>

	<div class="admin-form">

	    <?php $form = ActiveForm::begin(['enableClientValidation' => true]); ?>

	    <?=$form->field($model, 'type')->dropDownList((new Settings)->getTypeArray());?>

	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
