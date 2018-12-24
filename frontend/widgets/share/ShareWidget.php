<?php
namespace frontend\widgets\share;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

class ShareWidget extends \yii\base\Widget 
{

	public $share;
	public $wrap;
	public $wrapClass;
	public $itemWrapClass;
	public $itemClass = 'share btn-share';
	public $addItemClasses = ['fb' => 'btn-facebook', 'tw' => 'btn-twitter', 'ok' => 'btn-odnoklassniki', 'vk' => 'btn-vk', 'tg' => 'btn-telegram'];
	public $showButtons = true;

    public function run() {
    	$socialsArr = Yii::$app->settings->get('socials');
	    
	    $share = $this->share;
	    $share['image_fb'] = (isset($share['image_fb']) && $share['image_fb']) ? Url::to(Yii::$app->image->getImageUrl($share['image_fb']), true) : Url::to(Yii::$app->image->getImageUrl($share['image']), true);
	    $share['image_tw'] = (isset($share['image_tw']) && $share['image_tw']) ? Url::to(Yii::$app->image->getImageUrl($share['image_tw']), true) : Url::to(Yii::$app->image->getImageUrl($share['image']), true);
	    $share['text'] = $share['text'] == '' ? '&nbsp;' : $share['text'];
        
        $view = $this->getView();
        
	    $view->registerMetaTag(['property' => 'og:title', 'content' => $share['title']], 'og:title');
		$view->registerMetaTag(['property' => 'og:image', 'content' => $share['image_fb']], 'og:image');
	    $view->registerMetaTag(['property' => 'og:url', 'content' => $share['url']], 'og:url');
	    $view->registerMetaTag(['property' => 'og:description', 'content' => $share['text']], 'og:description');
	    $view->registerMetaTag(['property' => 'og:type', 'content' => 'website'], 'og:type');

    	if(empty($socialsArr)) {
    		return false;
    	}

    	if($this->showButtons) {
	    	if(in_array('fb', $socialsArr)) {
		    	echo $this->renderWrapOpen($soc = 'fb');
				    echo Html::a('<i class="fa fa-facebook"></i>', '#', [
				        'class' => $this->itemClass.' '.(isset($this->addItemClasses['fb']) ? $this->addItemClasses['fb'] : ''),
				        'data-type' => 'fb',
				        'data-url' => $share['url'],
				        'data-title' => $share['title'],
				        'data-image' => $share['image_fb'],
				        'data-text' => $share['text'],
				    ]);
				echo $this->renderWrapClose();
			}

	    	if(in_array('tw', $socialsArr)) {
				echo $this->renderWrapOpen($soc = 'tw');
				    echo Html::a('<i class="fa fa-twitter"></i>', '#', [
				        'class' => $this->itemClass.' '.(isset($this->addItemClasses['tw']) ? $this->addItemClasses['tw'] : ''),
				        'data-type' => 'tw',
				        'data-url' => $share['url'],
				        'data-title' => $share['twitter'],
				        'data-image' => $share['image_tw'],
				    ]);
				echo $this->renderWrapClose();
			}

	    	if(in_array('ok', $socialsArr)) {
				echo $this->renderWrapOpen($soc = 'ok');
				    echo Html::a('<i class="fa fa-odnoklassniki"></i>', '#', [
				        'class' => $this->itemClass.' '.(isset($this->addItemClasses['ok']) ? $this->addItemClasses['ok'] : ''),
				        'data-type' => 'ok',
				        'data-title' => $share['title'],
				        'data-image' => $share['image'],
				        'data-url' => $share['url'],
				        'data-text' => $share['text'],
				    ]);
				echo $this->renderWrapClose();
			}

	    	if(in_array('vk', $socialsArr)) {
				echo $this->renderWrapOpen($soc = 'vk');
				    echo Html::a('<i class="fa fa-vk"></i>', '#', [
				        'class' => $this->itemClass.' '.(isset($this->addItemClasses['vk']) ? $this->addItemClasses['vk'] : ''),
				        'data-type' => 'vk',
				        'data-url' => $share['url'],
				        'data-title' => $share['title'],
				        'data-image' => $share['image'],
				        'data-text' => $share['text'],
				    ]);
				echo $this->renderWrapClose();
			}

	    	if(in_array('tg', $socialsArr)) {
				echo $this->renderWrapOpen($soc = 'tg');
				    echo Html::a('<img src="/images/icons/telegram_white.svg">', '#', [
				        'class' => $this->itemClass.' '.(isset($this->addItemClasses['tg']) ? $this->addItemClasses['tg'] : ''),
				        'data-type' => 'tg',
				        'data-url' => $share['url'],
				        'data-title' => $share['title'],
				    ]);
				echo $this->renderWrapClose();
			}
		}
    }

    public function renderWrapOpen($soc = null) {
	    if($this->wrap) {
	        $open = '<'.$this->wrap;
	        if($this->wrapClass) {
	            $open .= ' class="'.$this->wrapClass;
	            if($this->itemWrapClass && $soc) {
	                $open .= ' '.$this->itemWrapClass.$soc;
	            }
	            $open .= '"';
	        }
	        $open .= '>';
	        return $open;
	    }
	}
	
	public function renderWrapClose() {
	    if($this->wrap) {
	        return '</'.$this->wrap.'>';
	    }
	}
}