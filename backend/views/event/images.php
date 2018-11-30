<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use mihaildev\elfinder\InputFile;

$this->title = $event->title.' - Загрузить картинки';
$this->params['breadcrumbs'][] = ['label' => 'События', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\backend\widgets\cropimage\ImageInputAsset::register($this);
?>

<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([
        'id' => 'event-images-form'
    ]); ?>
	    <? InputFile::widget([
		    'language'   => 'ru',
		    'controller' => 'elfinderLocal', // вставляем название контроллера, по умолчанию равен elfinder
		    //'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории  
		    'filter'     => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
		    'name'       => 'image',
		    'value'      => '',
			'buttonName' => 'Выбрать файл',
			'id' => 'sourceImage',
		]);?>

		<?=Html::fileInput('image', '', ['id' => 'inputImage']);?>

	    <?php foreach ($cropForms as $i => $cropForm):?>
	    	<h3><?=$cropForm->header;?></h3>
		    <div class="row image-row" data-i="<?=$i;?>">
				<div class="col-sm-10">
		            <div style="max-height: 500px;">
		            	<img class="image" id="image<?=$i;?>" src="">
		            </div>
		        </div>
				<div class="col-sm-2">
		            <div class="inputs">
		            	<div class="sizes-wrap">
							<?= Html::activeTextInput($cropForm, "[$i]imageWidth", ['readonly' => true]) ?>
							&times;
							<?= Html::activeTextInput($cropForm, "[$i]imageHeight", ['readonly' => true]) ?>
						</div>
						<?= Html::activeHiddenInput($cropForm, "[$i]attribute") ?>


        				<?= Html::activeLabel($cropForm, "[$i]x", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($cropForm, "[$i]x", ['class' => 'x', 'readonly' => true]) ?>
        				<?= Html::activeLabel($cropForm, "[$i]y", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($cropForm, "[$i]y", ['class' => 'y', 'readonly' => true]) ?>
        				<?= Html::activeLabel($cropForm, "[$i]width", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($cropForm, "[$i]width", ['class' => 'width', 'readonly' => true]) ?>
        				<?= Html::activeLabel($cropForm, "[$i]height", ['class' => 'control-label']) ?>
						<?= Html::activeTextInput($cropForm, "[$i]height", ['class' => 'height', 'readonly' => true]) ?>
						<?//= Html::activeTextInput($cropForm, "[$i]scaleX", ['class' => 'scaleX', 'readonly' => true]) ?>
						<?//= Html::activeTextInput($cropForm, "[$i]scaleY", ['class' => 'scaleY', 'readonly' => true]) ?>

						<div class="preview"></div>

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

	function initCroppers() {
		var rows = $('.image-row');
		for (var j = 1; j <= rows.length; j++) {
			i = j - 1;
			var row = $(rows[i]);
			images.push($(rows[i]).find('.image'));
			images[i].cropper({
            	preview: '.preview',
				viewMode: 1,
				dragMode: 'move',
			    //minCropBoxWidth: $('#cropform-'+i+'-imagewidth').val(),
			    //minCropBoxHeight: $('#cropform-'+i+'-imageheight').val(),
			    aspectRatio: $('#cropform-'+i+'-imagewidth').val() / $('#cropform-'+i+'-imageheight').val(),
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
		var result = cropper[i].getCroppedCanvas({width: $('#cropform-'+i+'-imagewidth').val(), height: $('#cropform-'+i+'-imageheight').val()})
		$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);
		$('#getCroppedCanvasModal .modal-dialog').css({width: parseInt($('#cropform-'+i+'-imagewidth').val()) + 30});

		return false;
	});

    $('#inputImage').change(function(e) {
    	if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //$('#your_img').attr('src', e.target.result);
				$('.image').attr('src', e.target.result);
				initCroppers();
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
";

$this->registerJs($script, yii\web\View::POS_END);?>