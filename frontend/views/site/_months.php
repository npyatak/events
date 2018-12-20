<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;
use common\components\ThumbnailImage;

use common\models\Event;
?>

<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
	<div class="month-items" id="month_<?=$monthNumber;?>">
		<h3 class="general-lid"><?=Yii::$app->controller->yearModel->leading_text;?></h3>
		<div class="month-title">
			<h2><?=StringHelper::ucfirst($m[0]);?></h2>
			<div class="share-inline">
				<span class="share-inline_btn"><i class="ion-android-share"></i></span>
				<?php $shares[$monthNumber]['url'] = Url::toRoute(['site/month', 'year' => Yii::$app->controller->yearModel->number, 'id' => $monthNumber], true);
				$shares[$monthNumber]['image'] = Url::to(Yii::$app->image->getImageUrl($shares[$monthNumber]['image']), true);
				?>
	            <?= \frontend\widgets\share\ShareWidget::widget([
	                'share' => $shares[$monthNumber],
	            ]);?>
			</div>
		</div>
		<div class="masonry-items">
			<?php if(isset($events[$monthNumber])):?>
				<?php foreach ($events[$monthNumber] as $event) {
					echo $this->render('_event', ['event' => $event, 'category' => $category]);
				}?>
			<?php endif;?>
		</div>
	</div>
<?php endforeach;?>