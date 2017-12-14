<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\components\ThumbnailImage;

use common\models\Event;
use common\models\Settings;

$this->registerJsFile(Url::toRoute('js/general_page.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);

$image = $shares[0]->getImageUrl($shares[0]->image);

$this->registerMetaTag(['property' => 'og:description', 'content' => $shares[0]->text], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $shares[0]->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::canonical()], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');
?>
<header>
	<div class="header_inner" <?=Yii::$app->settings->get('mainPageImage') ? 'style="background-image: url('.ThumbnailImage::getLocalImageUrl(Settings::getImageSrcPath().Yii::$app->settings->get("mainPageImage"), "1280x380").');"' : '';?>>
		<div class="image">
			<img src="<?=Url::to('images/general_page/2018-2.svg');?>" alt="Events 2018">
		</div>
		<div class="container">
			<div class="slogan">
				<h1><!--?=Yii::$app->settings->get('projectTitle');?--></h1>
			</div>
<!--			<div class="desc">-->
<!--				<span>Из сотни событий, которые могут произойти</span>-->
<!--			</div>-->
			<div class="general_share">
				<ul>
					<li>
                        <?=Html::a('<i class="fa fa-facebook"></i>', '', [
                            'class' => 'g-share-btn share',
                            'data-type' => 'fb',
                            'data-url' => Url::canonical(),
                            'data-title' => $shares[0]->title,
                            'data-image' => $image,
                            'data-desc' => $shares[0]->text,
                        ]);?>
                    </li>
                    <li>
                        <?=Html::a('<i class="fa fa-vk"></i>', '', [
                            'class' => 'g-share-btn share',
                            'data-type' => 'vk',
                            'data-url' => Url::canonical(),
                            'data-title' => $shares[0]->title,
                            'data-image' => $image,
                            'data-desc' => $shares[0]->text,
                        ]);?>
                    </li>
                    <li>
                        <?=Html::a('<i class="fa fa-twitter"></i>', '', [
                            'class' => 'g-share-btn share',
                            'data-type' => 'tw',
                            'data-url' => Url::canonical(),
                            'data-title' => $shares[0]->twitter,
                        ]);?>
                    </li>
                    <li>
                        <?=Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
                            'class' => 'g-share-btn share',
                            'data-type' => 'ok',
                            'data-url' => Url::canonical(),
                            'data-desc' => $shares[0]->text,
                        ]);?>
                    </li>
                    <li>
                        <?=Html::a('<i class="fa fa-telegram"></i>', '', [
                            'class' => 'g-share-btn share',
                            'data-type' => 'tg',
                            'data-url' => Url::canonical(),
                            'data-desc' => $shares[0]->text,
                        ]);?>
                    </li>
				</ul>
			</div>
		</div>
	</div>
</header>
<div class="general_content">
	<div class="container">
		<div class="general_content-inner scrollSpy_wrap">
			<div class="navigation">
				<ul>
					<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
					<li <?=(isset($month) && $month == $m[0]) ? 'class="active"' : '';?>>
						<a href="#m_<?=$monthNumber;?>" class="scroll-month month_<?=$monthNumber;?>">
							<span></span>
							<span class="month"><?=$m[0];?></span>
						</a>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<div class="content" id="events">
				<?=$this->render('_months', ['events' => $events, 'category' => $category, 'shares' => $shares]);?>
			</div>
			<aside class="scrollSpy">
				<span class="close_aside"><i class="ion-android-close"></i></span>
				<ul class="categories">
					<li><a href="<?=Url::current(['category' => null]);?>" <?=$category ? '' : 'class="active"';?>>Все события</a></li>
					<?php foreach ($categories as $cat):?>
					<li><a href="<?=$cat->url;?>" <?=$category == $cat->alias ? 'class="active"' : '';?> data-category="<?=$cat->alias;?>"><?=$cat->title;?></a></li>
					<?php endforeach;?>
				</ul>
			</aside>
		</div>
	</div>
</div>
<?php $script = "
    $('.categories a').on('click', function() {
    	var elem = $(this);

        $('.grid-item').addClass('inactive');
        $('.grid-item.cat_'+elem.data('category')).removeClass('inactive');

        history.pushState(null, '', elem .attr('href'));
        
        $('.categories a').removeClass('active');
        elem.addClass('active');
		
		if($(this).hasClass('all')){
			$('.grid-item').removeClass('inactive');
		}
		
        // $.ajax({
        //     url: elem.attr('href'),
        //     success: function(data) {
        //         var html = $(data);
        //         $('#events').html(data);
                
        //         history.pushState(null, '', elem .attr('href'));

        //         masonryInit();

        //         $('.categories a').removeClass('active');
        //         elem.addClass('active');
        //     }
        // });

        return false;
    });
";?>
<?php $this->registerJs($script, yii\web\View::POS_END);?>