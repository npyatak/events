<?php
use yii\helpers\Html;
use mihaildev\elfinder\ElFinder;

?>
<div class="site-login">
    <h2>CDN ТАСС</h2>

    <?= ElFinder::widget([
        'language'         => 'ru',
        //'controller'       => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        //'filter'           => 'application/pdf',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        //'path' => 'events/images',
        'frameOptions' => [
            'style' => 'height: 500px; width: 100%'
        ]
    ]);
    ?>

    <h2>CDN Яндекс</h2>
    <?= ElFinder::widget([
        'language'         => 'ru',
        'controller'       => 'elfinderYandex', // вставляем название контроллера, по умолчанию равен elfinder
        //'filter'           => 'application/pdf',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
        //'path' => 'test',
        'frameOptions' => [
            'style' => 'height: 500px; width: 100%'
        ]
    ]);
    ?>
</div>
