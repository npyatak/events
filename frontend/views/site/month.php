<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;

use common\models\Event;

$this->params['share'] = [
	'url' => Url::toRoute(['site/month', 'id' => $month, 'year' => Yii::$app->controller->yearModel->number], true),
	'text' => $share->text,
	'title' => $share->title,
	'image' => $share->image,
	'twitter' => $share->twitter,
	'image_fb' => $share->image_fb,
	'image_tw' => $share->image_tw,
];

echo \frontend\widgets\share\ShareWidget::widget([
    'share' => $this->params['share'],
    'showButtons' => false,
]);
?>

<div class="month-items">
	<?php $m = Event::getMonthsArray()[$month];?>
	<div class="month-title"><h2><?=StringHelper::ucfirst($m[0]);?></h2></div>

	<div class="masonry-items">
		<?php if(isset($events)):?>
			<?php foreach ($events as $event) {
				//echo $this->render('_event', ['event' => $event, 'category' => $category]);
			}?>
		<?php endif;?>
	</div>
</div>

<?php $script = "
    window.location.href = '".Url::toRoute(['site/index', 'year' => Yii::$app->controller->yearModel->number, 'month' => $month])."';
";

$this->registerJs($script, yii\web\View::POS_END);?>