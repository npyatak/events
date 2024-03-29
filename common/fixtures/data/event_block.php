<?php
/*
BlockContent
BlockContent
BlockFlipCard
BlockQuotation
BlockImage
BlockGallery
BlockFact
BlockCard
BlockCut
BlockMap
BlockIframe
*/
return [
	[
	    'event_id' => 1,
	    'model' => 'BlockContent',
	    'block_id' => 1,
	    'order' => 1,
	    'anchor' => 'content',
	    'block' => [
	    	'text' => '
	    		<div class="grey-line">
					<div class="title">Серый разделитель</div>
				</div>
	    		<p>Контент со списками</p>
                    	
				<ol>
					<li>пункт</li>
					<li>2 пункт</li>
					<li>3 пункт</li>
					<li>пункт</li>
				</ol>
				<hr class="blue">
				<ul>
					<li>1 пункт</li>
					<li>2 пункт</li>
					<li>3ывоывао выдофадфлда ываофдлао</li>
				</ul>'
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockContent',
	    'block_id' => 2,
	    'order' => 2,
	    'anchor' => '',
	    'block' => [
	    	'text' => '<p>Контент с таблицей</p>

					<table border="1" cellpadding="1" cellspacing="1">
						<tbody>
							<tr>
								<td>заголовок 1</td>
								<td>заголовок 2</td>
								<td>заголовок 3</td>
							</tr>
							<tr>
								<td>какие-то данные</td>
								<td>много каких-то данных, много каких-то данных, много каких-то данных</td>
								<td>фывфыв</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>много каких-то данных</td>
							</tr>
						</tbody>
					</table>'
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockFlipCard',
	    'block_id' => 1,
	    'order' => 3,
	    'anchor' => '',
	    'block' => [
	    	'width' => 660,
			'height' => 400,
			'text_front' => '<p><span style="color:#FFFF00">Минюст РФ признал девять СМИ иностранными агентами</span></p>',
			'text_back' => '<p>Российский эксперт не исключил провала миссии Волкера</p>',
			'image_front' => '/images/turn/Bitmap.jpg',
			'image_back' => '/images/turn/Bitmap2.jpg',
			'control_text' => 'Переверни',
			'capture_front' => 'подпись фронт',
			'capture_back' => 'подпись бэк',
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockQuotation',
	    'block_id' => 1,
	    'order' => 4,
	    'anchor' => '',
	    'block' => [
	    	'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
            'author_image' => '/images/icons/author.jpg',
            'author_name' => 'Игорь Комаров',
            'author_text' => 'Гендиректор государственной корпорации «Роскосмос» из интервью для портала Чердак: наука, технологии, будущее',
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockImage',
	    'block_id' => 1,
	    'order' => 5,
	    'anchor' => '',
	    'block' => [
	    	'text' => 'Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров.',
	    	'copyright_text' => 'Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров.',
            'source' => '/images/slider/image-1.jpg',
            'show_fullscreen' => 1,
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockGallery',
	    'block_id' => 1,
	    'order' => 6,
	    'anchor' => '',
	    'block' => [
	    	'title' => 'Тестовая галерея',
	    	'items' => [
                [
                	'image' => '/images/slider/image-1.jpg',
                	'title' => 'Заголовок 1',
                ],
                [
                	'image' => '/images/slider/image-1.jpg',
                	'title' => 'Заголовок 2',
                ],
	    	]
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockFact',
	    'block_id' => 1,
	    'order' => 7,
	    'anchor' => '',
	    'block' => [
	    	'title' => 'Заголовок для серой отсечки',
	    	'items' => [
                [
                    'number' => '11',
                    'capture' => 'веселых друзей',
                    'type' => 1,
                    'link' => 'открыть',
                    'text' => 'Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров.',
                ],
                [
                    'number' => 'миллион',
                    'capture' => 'алых роз',
                    'type' => 1,
                    'link' => 'получить',
                    'text' => '<p>не в серьез</p>',
                ],
	    	]
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockCard',
	    'block_id' => 1,
	    'order' => 8,
	    'anchor' => '',
	    'block' => [
	    	'title' => 'Заголовок к верхнему разделителю',
	    	'items' => [
                [
                    'title' => 'заголовок',
                    'icon' => 1,
                    'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
                ],
                [
                    'title' => 'карточка с вопросом',
                    'icon' => 2,
                    'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
                ],
	    	]
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockCut',
	    'block_id' => 1,
	    'order' => 9,
	    'anchor' => 'cut',
	    'block' => [
	    	'title' => 'Заголовок',
	    	'preview' => 'Какой-то текст',
	    	'text' => '<p>ПодзаголовокПодзаголовокПодзаголовокПодзаголовокПодзаголовок</p>',

		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockMap',
	    'block_id' => 1,
	    'order' => 10,
	    'anchor' => 'map',
	    'block' => [
	    	'code' => '<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac744626dd944c9f23d1aac72409f87299177f42219e371b67deeb9a7ce714bd0&amp;width=100%25&amp;height=100%&amp;lang=ru_RU&amp;scroll=false"></script>',
	    	'caption' => 'Заголовок карты',
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockCutEnd',
	    'block_id' => 1,
	    'order' => 11,
	    'anchor' => 'cut',
	    'block' => [],
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockIframe',
	    'block_id' => 1,
	    'order' => 12,
	    'anchor' => 'iframe',
	    'block' => [
	    	'title' => 'Состыковка Dragon с бортом МКС',
	    	'code' => '<p><iframe frameborder="0" height="315" scrolling="no" src="https://www.youtube.com/embed/Xpuq4QI3M7k" width="500"></iframe></p>'
	    ],
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockTassVideo',
	    'block_id' => 1,
	    'order' => 13,
	    'anchor' => 'tass-video',
	    'block' => [
	    	'title' => 'Состыковка Dragon с бортом МКС',
	    	'list_1' => 'https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/jwplayer.smil',
	    	'list_2' => 'https://ecomon-vod.tass.ru/ecomon-vod/smil:ecomon01.smil/playlist.m3u8',
			'image' => 'https://phototass1.cdnvideo.ru/width/744_b12f2926/tass/m2/uploads/i/20171203/4610919.jpg',
	    ],
	],
];
?>