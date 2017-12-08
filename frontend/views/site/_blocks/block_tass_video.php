<?php
use frontend\assets\PlayerAsset;

PlayerAsset::register($this);
?>

<div id="block-video-<?=$block->id;?>"></div>

<?php
$str = "'width': ".($block->width ? $block->width : "'100%'").",";
if($block->height) {
	$str .= "'height': ".$block->height;
} else {
	$str .= "'aspectratio': '16:9'";
}

$script = "
	$(document).ready(function () {
	    jwplayer.key='btTjXiuYZsRbqAVggNOhFFVcP3mvO2KkI2kx4w==';

	    jwplayer('block-video-".$block->id."').setup({
	        ".$str.",
	        'bufferlength': '3',
	        'stretching': 'uniform',
	        'primary': 'flash',
	        'autostart': 'false',
	        'duration': '',
	        'playlist': [{
	            'image': '".$block->image."',
	            'sources': [
	                {file: '".$block->list_1."'},
	                {file: '".$block->list_2."'},
	            ]
	        }]
	    });
	})
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>