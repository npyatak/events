<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;

use common\models\Event;
?>

<div class="month-items">
	<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
	<div class="month-title"><h2><?=StringHelper::ucfirst($m[0]);?></h2></div>
	<div class="share-inline">
		<span class="share-inline_btn"><i class="fa fa-share-alt"></i></span>
        <?=Html::a('<i class="fa fa-facebook"></i>', '', [
            'class' => 'btn-share btn-facebook',
            'data-type' => 'fb',
            'data-url' => Url::toRoute(['site/month', 'id' => $monthNumber]),
            'data-title' => $shares[$monthNumber]->title,
            'data-image' => $shares[$monthNumber]->image,
            'data-desc' => $shares[$monthNumber]->text,
        ]);?>
        <?=Html::a('<i class="fa fa-vk"></i>', '', [
            'class' => 'btn-share btn-twitter',
            'data-type' => 'vk',
            'data-url' => Url::current(['month' => $monthNumber]),
            'data-title' => $shares[$monthNumber]->title,
            'data-image' => $shares[$monthNumber]->image,
            'data-desc' => $shares[$monthNumber]->text,
        ]);?>
        <?=Html::a('<i class="fa fa-twitter"></i>', '', [
            'class' => 'btn-share btn-odnoklassniki',
            'data-type' => 'tw',
            'data-url' => Url::current(['month' => $monthNumber]),
            'data-title' => $shares[$monthNumber]->title,
        ]);?>
        <?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
            'class' => 'btn-share btn-vk',
            'data-type' => 'ok',
            'data-url' => Url::current(['month' => $monthNumber]),
            'data-desc' => $shares[$monthNumber]->text,
        ]);?>
        <?=Html::a('<i class="fa fa-telegram"></i>', '', [
            'class' => 'btn-share btn-telegram',
            'data-type' => 'tg',
            'data-url' => Url::current(['month' => $monthNumber]),
            'data-desc' => $shares[$monthNumber]->text,
        ]);?>
	</div>
	<div class="masonry-items">
		<?php if(isset($events[$monthNumber])):?>
			<?php foreach ($events[$monthNumber] as $event) {
				echo $this->render('_event', ['event' => $event, 'category' => $category]);
			}?>
		<?php endif;?>
	</div>
	<?php endforeach;?>
</div>