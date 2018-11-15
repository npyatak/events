<?php
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\StringHelper;

use common\models\Event;

$this->registerMetaTag(['property' => 'og:description', 'content' => $share->text], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $share->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => Url::to($share->imageUrl, true)], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::canonical()], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
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
    window.location.href = '".Url::home()."';
";

$this->registerJs($script, yii\web\View::POS_END);?>