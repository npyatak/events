<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

use common\models\Event;
use common\models\Settings;

$this->registerJsFile(Url::toRoute('js/general_page.js'), ['depends' => [\yii\web\JqueryAsset::className()]]);

$image = Url::to(Yii::$app->image->getImageUrl($shares[0]->image), true);

$this->registerMetaTag(['property' => 'og:description', 'content' => $shares[0]->text], 'og:description');
$this->registerMetaTag(['property' => 'og:title', 'content' => $shares[0]->title], 'og:title');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'og:image');
$this->registerMetaTag(['property' => 'og:url', 'content' => Url::toRoute(['site/index', 'year' => Yii::$app->controller->yearModel->number], true)], 'og:url');
$this->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');

$this->params['share'] = ['text' => $shares[0]->text, 'title' => $shares[0]->title, 'image' => $image, 'twitter' => $shares[0]->twitter];

$useragent=$_SERVER['HTTP_USER_AGENT'];
$this->params['is_mobile'] = preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
?>
<header>
	<div class="header_inner">
		<div class="image">
			<img src="<?=Yii::$app->image->getImageUrl(Yii::$app->controller->yearModel->main_page_image);?>" alt="<?=Yii::$app->controller->yearModel->title;?>">
		</div>
		<div class="container">
			<div class="slogan">
				<h1><!--?=Yii::$app->settings->get('projectTitle');?--></h1>
			</div>
			<div class="general_share">
				<ul>
                    <?php $share = [
                        'title' => $shares[0]->title,
                        'text' => $shares[0]->text,
                        'twitter' => $shares[0]->twitter,
                        'image' => $image, 
                        'url' => Url::toRoute(['site/index', 'year' => Yii::$app->controller->yearModel->number], true)
                    ];?>
                    <?= \frontend\widgets\share\ShareWidget::widget([
                        'share' => $share,
                        'wrap' => 'li',
                        'itemClass' => 'g-share-btn share',
                    ]);?>
				</ul>
			</div>
		</div>
	</div>
</header>
<div class="general_content">
	<div class="container">
		<div class="general_content-inner scrollSpy_wrap">
			<div class="navigation scrollSpy">
				<ul>
					<?php foreach (Event::getMonthsArray() as $monthNumber => $m):?>
					<li <?=(isset($month) && $month == $m[0]) ? 'class="active"' : '';?>>
						<a href="#month_<?=$monthNumber;?>" class="scroll-month month_<?=$monthNumber;?>">
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
			<aside>
				<span class="close_aside"><i class="ion-android-close"></i></span>
				<ul class="categories">
					<li><a href="<?=Url::current(['category' => null]);?>" <?=$category ? '' : 'class="active"';?>>Все</a></li>
					<?php foreach ($categories as $cat):?>
					<li><a href="<?=$cat->url;?>" <?=$category == $cat->alias ? 'class="active"' : '';?> data-category="<?=$cat->alias;?>"><?=$cat->title;?></a></li>
					<?php endforeach;?>
				</ul>
				
				<?php if(Yii::$app->controller->yearModel->partner_url && Yii::$app->controller->yearModel->partner_text):?>
					<!-- для того что бы отобразить текст жирным добавляем к partner_refer класс bold, а чтобы сделать курсивом класс italic  -->
					<div class="partner_refer m-t-30">
                        <div class="partner_img" style="background-image: url(<?=Yii::$app->image->getImageUrl(Yii::$app->controller->yearModel->partner_image_index);?>);"></div>
						<a href="<?=Yii::$app->controller->yearModel->partner_url;?>" class="red">
							<p><?=Yii::$app->controller->yearModel->partner_text;?></p>
						</a>
					</div>
				<?php endif;?>
			</aside>



		</div>
		<?php if($otherYears):?>
	        <div class="other-years">
	        	<?php foreach ($otherYears as $y) {
	        		echo Html::a('События '.$y->number, $y->url);
	        	}?>
	        </div>
	    <?php endif;?>
	</div>
</div>

<?php $script = "
	$(document).ready(function () {
	    var monthId = GetURLParameter('month');	
	    
	    $('.scroll-month').click(function (e) {
			e.preventDefault();
			var target = $(this).attr('href');
			scrollToMonth(target, 'month_1');
		});
	
		function GetURLParameter(sParam) {
			var sPageURL = window.location.search.substring(1);
			var sURLVariables = sPageURL.split('&');
	
			for (var i = 0; i < sURLVariables.length; i++) {
				var sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] == sParam) {
					return sParameterName[1];
				}
			}
		}
		
		var currentScreen;
		var goTos = $('.scroll-month');
		var sections = $('.month-items');
	
		function setActivationStatus(el, currentScreen) {
			if (el.getAttribute('href') === currentScreen) {
				el.parentElement.classList.add('active');
			} else {
				el.parentElement.classList.remove('active');
			}
		}
	
		function onScroll() {
			for (var i = 0; i < sections.length; i++) {
				var rect = sections[i].getBoundingClientRect();
	
				if (rect.top < 150 && rect.height + rect.top > 150) {
					currentScreen = '#' + sections[i].getAttribute('id');
					for (var i = 0; i < goTos.length; i++) {
						setActivationStatus(goTos[i], currentScreen);
					}
				}
			}
			
			$('.month-items').removeClass('active');
			$('.month-items:first-child').addClass('active');
		}
		
	    var monthId = ".$month.";
	    if(monthId) {
	        scrollToMonth('#month_'+monthId);
	        setTimeout(function () {
	            $('.navigation').find('li.active').removeClass('active');
	            $('.navigation').find('.month_'+monthId).parent().addClass('active');
	            $('#events').find('month_items.active').removeClass('active');
	            $('#events').find('#month_'+monthId).addClass('active');
	        },50);
	        setTimeout(function () {
	            $(window).on('scroll', function () {
	                var win_scr_top = $(window).scrollTop();
	                if(win_scr_top <= 30){
	                    $('header, .general_content, .main-menu').removeClass('transform');
	                }else if(win_scr_top >= 0){
	                    $('header, .general_content, .main-menu').addClass('transform');
	                }
	                scrollSpy();
	                onScroll();
	                scrollSpy2();
	            });
	        },3000);
	    } else {
	        $(window).on('scroll', function () {
	            var win_scr_top = $(window).scrollTop();
	            if(win_scr_top <= 30){
	                $('header, .general_content, .main-menu').removeClass('transform');
	            }else if(win_scr_top >= 0){
	                $('header, .general_content, .main-menu').addClass('transform');
	            }
	            scrollSpy();
	            onScroll();
	        });
	    }
	    
	    function scrollToMonth(target, hasClass) {
			if($(window).width() >= 768) {
				if(typeof hasClass == 'undefined'){
					$(window).on('load',function () {
						$('html, body').animate({scrollTop:($(target).offset().top - 360)},500);
					});
				}else{
					if($(window).scrollTop() <= 0){
						$('html, body').animate({scrollTop:($(target).offset().top - 420)},500);
					}else{
						$('html, body').animate({scrollTop:($(target).offset().top - 120)},500);
					}
				}
			}else{
				console.log(monthId)
				if(monthId === 1){
					$(window).on('load',function () {
						$('html, body').animate({scrollTop:($(target).offset().top - 200)},500);
					});
				}else{
					$('html, body').animate({scrollTop:($(target).offset().top - 200)},500);
				}
			}
		}
		
		function scrollSpy() {
			var footer_top = $('footer').offset().top;
			var a = window.pageYOffset + window.innerHeight;
			var scrollSpy_wrap = $('.scrollSpy_wrap');
			var scrollSpy_el = $('.scrollSpy');
			if(a >= footer_top){
				$(scrollSpy_wrap).find(scrollSpy_el).addClass('no-fixed');
			}else{
				$(scrollSpy_wrap).find(scrollSpy_el).removeClass('no-fixed');
			}
		}
		
		function scrollSpy2() {
			var footer_top = $('footer').offset().top;
			var scrollSpy_el = $('aside');
			var a = window.pageYOffset + scrollSpy_el.height() + 200;
			var scrollSpy_wrap = $('.scrollSpy_wrap');
			console.log(a)
			console.log(footer_top)
			if(a >= footer_top){
				$(scrollSpy_wrap).find(scrollSpy_el).addClass('no-fixed');
			}else{
				$(scrollSpy_wrap).find(scrollSpy_el).removeClass('no-fixed');
			}
		}
	});

";

$this->registerJs($script, yii\web\View::POS_END);?>