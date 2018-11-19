<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\elfinder\InputFile;

$this->title = $event->title.' - Загрузить картинки';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\backend\widgets\cropimage\CropImageAsset::register($this);
?>

<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([
        'id' => 'event-images-form'
    ]); ?>
	    <?= InputFile::widget([
		    'language'   => 'ru',
		    'controller' => 'elfinderLocal', // вставляем название контроллера, по умолчанию равен elfinder
		    //'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории  
		    'filter'     => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
		    'name'       => 'image',
		    'value'      => '',
			'buttonName' => 'Выбрать файл',
			'id' => 'sourceImage',
		]);?>

	    <?php foreach ($eventImagesForms as $i => $imagesForm):?>
	    	<h3><?=$imagesForm->header;?></h3>
		    <div class="row image-row" data-i="<?=$i;?>">
				<div class="col-sm-10">
		            <div style="max-height: 500px;">
		            	<img class="image" id="image<?=$i;?>" src="">
		            </div>
		        </div>
				<div class="col-sm-2">
		            <div class="inputs">
		            	<div class="sizes-wrap">
							<?= Html::activeTextInput($imagesForm, "[$i]imageWidth", ['readonly' => true]) ?>
							&times;
							<?= Html::activeTextInput($imagesForm, "[$i]imageHeight", ['readonly' => true]) ?>
						</div>
						<?= Html::activeHiddenInput($imagesForm, "[$i]eventAttribute") ?>


        				<?= Html::activeLabel($imagesForm, "[$i]x", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($imagesForm, "[$i]x", ['class' => 'x', 'readonly' => true]) ?>
        				<?= Html::activeLabel($imagesForm, "[$i]y", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($imagesForm, "[$i]y", ['class' => 'y', 'readonly' => true]) ?>
        				<?= Html::activeLabel($imagesForm, "[$i]width", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($imagesForm, "[$i]width", ['class' => 'width', 'readonly' => true]) ?>
        				<?= Html::activeLabel($imagesForm, "[$i]height", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($imagesForm, "[$i]height", ['class' => 'height', 'readonly' => true]) ?>
						<?//= Html::activeTextInput($imagesForm, "[$i]scaleX", ['class' => 'scaleX', 'readonly' => true]) ?>
						<?//= Html::activeTextInput($imagesForm, "[$i]scaleY", ['class' => 'scaleY', 'readonly' => true]) ?>

						<button class="getCroppedCanvas btn btn-success">Результат</button>
			        </div>
			    </div>
		    </div>
		<?php endforeach;?>

	    <div class="form-group">
	        <?= Html::submitButton($event->isNewRecord ? 'Создать' : 'Обновить', ['class' => $event->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Show the cropped image in modal -->
<div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="getCroppedCanvasTitle">Результат</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
	      	<div class="modal-body"></div>
	      	<div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	      	</div>
    	</div>
  	</div>
</div>

<?php $script = "
	var images = [];
	var cropper = [];

	$('#sourceImage').change(function(e) {
		$('.image').attr('src', $(this).val());
		initCroppers();
	})

	// image.cropper({
	//     minCropBoxWidth: 540,
	//     minCropBoxHeight: 290,
	//     aspectRatio: 540 / 290,
	//     crop: function(event) {
	//         console.log(event.detail.x);
	//         console.log(event.detail.y);
	//         console.log(event.detail.width);
	//         console.log(event.detail.height);
	//         console.log(event.detail.rotate);
	//         console.log(event.detail.scaleX);
	//         console.log(event.detail.scaleY);
	//     }
	// });

	// Get the Cropper.js instance after initialized
	//var cropper = image.data('cropper');

	//initCroppers();

	function initCroppers() {
		var rows = $('.image-row');
		for (var j = 1; j <= rows.length; j++) {
			i = j - 1;
			var row = $(rows[i]);
			images.push($(rows[i]).find('.image'));
			images[i].cropper({
				viewMode: 1,
				dragMode: 'move',
			    //minCropBoxWidth: $('#eventimagesform-'+i+'-imagewidth').val(),
			    //minCropBoxHeight: $('#eventimagesform-'+i+'-imageheight').val(),
			    aspectRatio: $('#eventimagesform-'+i+'-imagewidth').val() / $('#eventimagesform-'+i+'-imageheight').val(),
			    crop: function(event) {
			        $(event.target).closest('.image-row').find('.x').val(event.detail.x);
			        $(event.target).closest('.image-row').find('.y').val(event.detail.y);
			        $(event.target).closest('.image-row').find('.width').val(event.detail.width);
			        $(event.target).closest('.image-row').find('.height').val(event.detail.height);
			        //$(event.target).closest('.image-row').find('.scaleX').val(event.detail.scaleX);
			        //$(event.target).closest('.image-row').find('.scaleY').val(event.detail.scaleY);
			        console.log(event.detail);
			    }
			});

			cropper.push(images[i].data('cropper'));
		}
	}

	$('.getCroppedCanvas').click(function(e) {
		i = $(this).closest('.image-row').attr('data-i');
		var result = cropper[i].getCroppedCanvas({width: $('#eventimagesform-'+i+'-imagewidth').val(), height: $('#eventimagesform-'+i+'-imageheight').val()})
		$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
		$('#getCroppedCanvasModal .modal-dialog').css({width: parseInt($('#eventimagesform-'+i+'-imagewidth').val()) + 30});

		return false;
	})
";

$this->registerJs($script, yii\web\View::POS_END);?>