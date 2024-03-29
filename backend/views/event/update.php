<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Изменить событие: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => $model->url];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Посмотреть на сайте', $model->url, ['class' => 'btn btn-success', 'target' => '_blank']) ?>
    </p>

    <?= $this->render('_form', [
        'model' => $model,
        'blockModelsArray' => $blockModelsArray,
        'cropFormArray' => $cropFormArray,
    ]) ?>

</div>

<?php $script = "
    editorModel();
	setInterval(editorModel, 30000);

	function editorModel() {
	    $.ajax({
	        url: '".Url::toRoute(['event/editor-model', 'id' => $model->id])."',
	    });
	}
";

if($editorModel !== null) {
    $script .= "
        alert('Внимание! Событие в данный момент редактируется другим пользователем!')
    ";
}

$this->registerJs($script, yii\web\View::POS_END);?>