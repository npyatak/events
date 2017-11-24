<div class="<?=$eventBlock->block->view;?>" <?=$eventBlock->anchor ? 'id="'.$eventBlock->anchor.'"' : '';?>>
	<?php if(isset($eventBlock->block) && file_exists(__DIR__.'/'.$eventBlock->block->view.'.php')) {
		echo $this->render($eventBlock->block->view, ['block' => $eventBlock->block]);
	} else {
		print_r($eventBlock->block->view);
	}
	?>
</div>