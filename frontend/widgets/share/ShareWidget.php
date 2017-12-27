<?php
namespace frontend\widgets\share;

use Yii;
use yii\helpers\Html;

class ShareWidget extends \yii\base\Widget 
{

	public $share;
	public $wrap;
	public $wrapClass;
	public $itemWrapClass;
	public $itemClass;
	public $addItemClasses = [];

    public function run() {
    	echo $this->renderWrapOpen($soc = 'fb');
		    echo Html::a('<i class="fa fa-facebook"></i>', '', [
		        'class' => $this->itemClass.' '.(isset($this->addItemClasses['fb']) ? $this->addItemClasses['fb'] : ''),
		        'data-type' => 'fb',
		        'data-url' => $this->share['url'],
		        'data-title' => $this->share['title'],
		        'data-image' => $this->share['image'],
		        'data-text' => $this->share['text'],
		    ]);
		echo $this->renderWrapClose();

		echo $this->renderWrapOpen($soc = 'tw');
		    echo Html::a('<i class="fa fa-twitter"></i>', '', [
		        'class' => $this->itemClass.' '.(isset($this->addItemClasses['tw']) ? $this->addItemClasses['tw'] : ''),
		        'data-type' => 'tw',
		        'data-url' => $this->share['url'],
		        'data-title' => $this->share['twitter'],
		    ]);
		echo $this->renderWrapClose();

		echo $this->renderWrapOpen($soc = 'ok');
		    echo Html::a('<i class="fa fa-odnoklassniki"></i>', '', [
		        'class' => $this->itemClass.' '.(isset($this->addItemClasses['ok']) ? $this->addItemClasses['ok'] : ''),
		        'data-type' => 'ok',
		        'data-url' => $this->share['url'],
		        'data-text' => $this->share['text'],
		    ]);
		echo $this->renderWrapClose();

		echo $this->renderWrapOpen($soc = 'vk');
		    echo Html::a('<i class="fa fa-vk"></i>', '', [
		        'class' => $this->itemClass.' '.(isset($this->addItemClasses['vk']) ? $this->addItemClasses['vk'] : ''),
		        'data-type' => 'vk',
		        'data-url' => $this->share['url'],
		        'data-title' => $this->share['title'],
		        'data-image' => $this->share['image'],
		        'data-text' => $this->share['text'],
		    ]);
		echo $this->renderWrapClose();

		echo $this->renderWrapOpen($soc = 'tg');
		    echo Html::a('<img src="/images/icons/telegram_white.svg">', '', [
		        'class' => $this->itemClass.' '.(isset($this->addItemClasses['tg']) ? $this->addItemClasses['tg'] : ''),
		        'data-type' => 'tg',
		        'data-url' => $this->share['url'],
		        'data-title' => $this->share['title'],
		    ]);
		echo $this->renderWrapClose();
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