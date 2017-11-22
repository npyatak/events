<?php
/*
BlockContent
BlockContent
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
	    	'text' => '<p>Контент со списками</p>
                    	
						<ol>
							<li>пункт</li>
							<li>2 пункт</li>
							<li>3 пункт</li>
							<li>пункт</li>
						</ol>

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
	    'model' => 'BlockQuotation',
	    'block_id' => 1,
	    'order' => 3,
	    'anchor' => '',
	    'block' => [
	    	'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
            'author_image' => 'https://phototass1.cdnvideo.ru/width/333_3412a45b/tass/m2/uploads/i/20140116/2330229.jpg',
            'author_name' => 'Игорь Комаров',
            'author_text' => 'Гендиректор государственной корпорации «Роскосмос» из интервью для портала Чердак: наука, технологии, будущее',
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockImage',
	    'block_id' => 1,
	    'order' => 4,
	    'anchor' => '',
	    'block' => [
	    	'text' => 'Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров.',
	    	'copyright_text' => 'Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров.',
            'source' => 'https://phototass1.cdnvideo.ru/width/333_3412a45b/tass/m2/uploads/i/20140116/2330229.jpg',
            'show_fullscreen' => 1,
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockGallery',
	    'block_id' => 1,
	    'order' => 5,
	    'anchor' => '',
	    'block' => [
	    	'title' => 'Тестовая галерея',
	    	'items' => [
                [
                	'image' => 'https://phototass1.cdnvideo.ru/width/333_3412a45b/tass/m2/uploads/i/20140116/2330229.jpg',
                	'title' => 'Заголовок 1',
                ],
                [
                	'image' => 'https://phototass4.cdnvideo.ru/crop/240x163_47061cc3/tass/m2/uploads/i/20171121/4602952.jpg',
                	'title' => 'Заголовок 2',
                ],
	    	]
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockFact',
	    'block_id' => 1,
	    'order' => 6,
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
	    'order' => 7,
	    'anchor' => '',
	    'block' => [
	    	'title' => 'Заголовок к верхнему разделителю',
	    	'items' => [
                [
                    'title' => 'заголовок',
                    'capture' => 'Подзаголовок',
                    'icon' => 1,
                    'link' => 'открыть',
                    'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
                ],
                [
                    'title' => 'карточка с вопросом',
                    'capture' => 'Подзаголовок',
                    'icon' => 2,
                    'link' => 'открыть',
                    'text' => '<span>Есть идея сделать станцию открытой конфигурации, которая была бы готова принимать всех партнеров. Мы понимаем, что следующая станция должна быть международным проектом &mdash; количество участников и, соответственно, инвестиций увеличивает эффективность работы</span>',
                ],
	    	]
		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockCut',
	    'block_id' => 1,
	    'order' => 8,
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
	    'order' => 9,
	    'anchor' => 'map',
	    'block' => [
	    	'code' => '<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Ac744626dd944c9f23d1aac72409f87299177f42219e371b67deeb9a7ce714bd0&amp;width=100%25&amp;height=100%&amp;lang=ru_RU&amp;scroll=false"></script>',

		]
	],
	[
	    'event_id' => 1,
	    'model' => 'BlockIframe',
	    'block_id' => 1,
	    'order' => 10,
	    'anchor' => 'iframe',
	    'block' => [
	    	'title' => 'Состыковка Dragon с бортом МКС',
	    	'code' => '<p><iframe frameborder="0" height="315" scrolling="no" src="https://www.youtube.com/embed/Xpuq4QI3M7k" width="500"></iframe></p>'
	    ],
	]
];
?>