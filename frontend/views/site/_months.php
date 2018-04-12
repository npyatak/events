<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;
use common\components\ThumbnailImage;

use common\models\Event;
?>

<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
<div class="month-items" id="month_<?=$monthNumber;?>">
	<h3 class="general-lid">Из сотни событий, которые могут произойти в 2018 году, мы отобрали десятки самых ожидаемых и обсуждаемых. Весь год мы будем следить за ключевыми темами и обновлять наш календарь, чтобы вы не пропустили ничего важного.</h3>
	<div class="month-title">
		<h2><?=StringHelper::ucfirst($m[0]);?></h2>
		<div class="share-inline">
			<span class="share-inline_btn"><i class="ion-android-share"></i></span>
			<?=Html::a('<i class="fa fa-facebook"></i>', '', [
				'class' => 'btn-share btn-facebook',
				'data-type' => 'fb',
				'data-url' => Url::toRoute(['site/month', 'id' => $monthNumber], true),
				'data-title' => $shares[$monthNumber]->title,
				'data-image' => Url::to($shares[$monthNumber]->getImageUrl($shares[$monthNumber]->image), true),
				'data-desc' => $shares[$monthNumber]->text,
			]);?>
			<?=Html::a('<i class="fa fa-twitter"></i>', '', [
				'class' => 'btn-share btn-twitter',
				'data-type' => 'tw',
				'data-url' => Url::current(['month' => $monthNumber], true),
				'data-title' => $shares[$monthNumber]->twitter,
			]);?>
			<?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
				'class' => 'btn-share btn-odnoklassniki',
				'data-type' => 'ok',
				'data-url' => Url::current(['month' => $monthNumber], true),
				'data-desc' => $shares[$monthNumber]->text,
			]);?>
			<?=Html::a('<i class="fa fa-vk"></i>', '', [
				'class' => 'btn-share btn-vk',
				'data-type' => 'vk',
				'data-url' => Url::current(['month' => $monthNumber], true),
				'data-title' => $shares[$monthNumber]->title,
				'data-image' => Url::to($shares[$monthNumber]->getImageUrl($shares[$monthNumber]->image), true),
				'data-desc' => $shares[$monthNumber]->text,
			]);?>
			<?=Html::a('<img src="/images/icons/telegram_white.svg">', '', [
				'class' => 'btn-share btn-telegram',
				'data-type' => 'tg',
				'data-url' => Url::current(['month' => $monthNumber], true),
				'data-title' => $shares[$monthNumber]->title,
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