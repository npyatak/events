<?php

use yii\db\Migration;

class m181013_111327_updates_for_year extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%year}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(4)->notNull()->comment('Год'),
            'is_current' => $this->integer(1)->comment('Текущий'),
            'show_on_main' => $this->integer(1)->comment('Показать на главной'),
            'title' => $this->string(255)->notNull()->comment('Заголовок проекта'),
            'leading_text' => $this->string(255)->comment('Текст преамбулы'),
            'logo_url' => $this->string(255)->comment('Ссылка с логотипа'),
            'main_page_image' => $this->string(255)->comment('Заглавное изображение'),
            'worked_on_project' => $this->text()->comment('Перечень работавших над проектом'),
            'used_multimedia' => $this->text()->comment('В материале использованы фотографии/видео'),
            'sources' => $this->text()->comment('Источники'),
            'gratitude' => $this->text()->comment('Блок благодарностей экспертам и организациям'),
            'additional' => $this->text()->comment('Дополнительный текстовый блок'),
            'partner_text' => $this->text()->comment('Текст партнера для правой колонки на главной'),
            'partner_url' => $this->string(255)->comment('Ссылка с текста партнера на главной'),
            'partner_image_index' => $this->string(255)->comment('Картинка баннера справа на главной'),
            'partner_image_event' => $this->string(255)->comment('Картинка баннера справа на событии'),
        ], $tableOptions);

        $this->batchInsert('{{%year}}', ['id', 'number', 'is_current', 'show_on_main', 'title', 'leading_text', 'logo_url', 'main_page_image', 'worked_on_project', 'used_multimedia', 'sources', 'gratitude', 'additional'], [
            [
                1,
                2018, 
                1, 
                1, 
                '2018: Краткое содержание',
                'Из сотни событий, которые могут произойти в 2018 году, мы отобрали десятки самых ожидаемых и обсуждаемых. Весь год мы будем следить за ключевыми темами и обновлять наш календарь, чтобы вы не пропустили ничего важного.',
                'http://tass.ru',
                '/images/general_page/2018-2.svg',
                '<p>Бильд-редакторы: Илона Грибовская, Павел Куколев. Монтаж видео: Сергей Асафов, Максим Макаров. Младший видео-дизайнер: Вера Назаренко. Видео-редактор: Анна Малинина, Влад Ясинский. Креативный продюсер: Владислав Важник. Арт-директор: Максим Малышев. Дизайнер: Екатерина Седогина. Иллюстраторы: Анастасия Зотова, Константин Каковкин, Оксана Маркова. Редакторы инфографики: Сабина Вахитова, Валерия Скуратова. Редакторы: Егор Беликов, Кристина Недкова, Тимур Фехретдинов. Продюсер: Ольга Махмутова.</p>',
                '<p>Фотохроника ТАСС (Александр Рюмин, Александр Щербак, Александра Мудрац, Алексей Филиппов, Антон Вергун, Антон Новодережкин, Артем Геодакян, Артем Коротаев, Валерий Шарифулин, Игорь Уткин, Марина Лысцева, Михаил Джапаридзе, Михаил Метцель, Михаил Терещенко,&nbsp;Николай Галкин,&nbsp;Петр Ковалев, Сергей Бобылев, Сергей Мальгавко, Сергей Савостьянов, Сергей Фадеичев, Станислав Красильников, Стоян Васев, Юрий Белинский), Omar Vega/Invision/AP, AP Photo/Jae C. Hong, EPA/ANTHONY ANEX, EPA/MAXIM SHIPENKOV, EPA/MARTIN DIVISEK, EPA/YURI KOCHETKOV, EPA-EFE/BALAZS MOHAI,&nbsp;EPA-EFE/SOUTH KOREA AIR FORCE,&nbsp;EPA-EFE/YONHAP, REUTERS/Kai Pfaffenbach, Kevin Winter/Getty Images, Kevork Djansezian/Getty Images,&nbsp;Kevin Winter/Getty Images, Sascha Steinbach/Getty Images, Steven Ryan/Getty Images, Laurent Viteur/Getty Images, STR/NurPhoto via Getty Images, Jean-Yves Ruszniewski/Corbis/VCG via Getty Images,&nbsp;<a href="https://stroi.mos.ru">Комплекс градостроительной политики и строительства города Москвы</a>, <a href="https://www.filmpro.ru">filmpro.ru</a>, пресс-служба киностудии «Союзмультфильм», пресс-служба «<a href="https://sochiautodrom.ru/">Автодром Сочи</a>», Пресс-служба «ВКонтакте», Airbus SAS; Vimeo/Vahana, VK/Союзмультфильм,&nbsp;YouTube/Кинокомпания «СТВ»,&nbsp;YouTube/ТАСС,&nbsp;YouTube/Яндекс.Такси,&nbsp;YouTube/AMEDIATEKA,&nbsp;YouTube/BostonDynamics,&nbsp;YouTube/Central Partnership, YouTube/Dynamo Moscow FC,&nbsp;YouTube/Eurovision Song Contest, YouTube/Gorillaz, YouTube/HD Трейлеры,&nbsp;YouTube/iVideos,&nbsp;YouTube/MARVEL Россия,&nbsp;YouTube/Netflix,&nbsp;YouTube/Novoekino, YouTube/Star Wars,&nbsp;YouTube/WBRussia.</p>',
                '<p><b id="docs-internal-guid-32901b1a-7d36-0637-4f36-8b5b34215506"><a href="https://blogs.nasa.gov/">blogs.nasa.gov</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d37-72ca-1174-c77c925ea7bb"><a href="http://www.cikrf.ru/">cikrf.ru</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d36-e88c-5b7e-76a4a703e033"><a href="http://fedtower.ru/">fedtower.ru</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d37-e1a0-e2cf-460f2fbb8d78"><a href="http://hyperloop.global/">hyperloop.global</a>,&nbsp;<a href="https://hyperloop-one.com/">hyperloop-one.com</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d36-8176-ce5f-a2807f62d431"><a href="https://www.mos.ru/">mos.ru</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d36-e88c-5b7e-76a4a703e033"><a href="http://lakhta.center/ru/">lakhta.center/ru/</a>, </b><b id="docs-internal-guid-32901b1a-7d38-dd54-45d9-381c5ecc979f"><a href="https://pnr360.ru">pnr360.ru</a>,&nbsp;</b><b id="docs-internal-guid-32901b1a-7d36-8176-ce5f-a2807f62d431"><a href="http://strelka-kb.com/">strelka-kb.com</a>,&nbsp;</b><b><a href="http://www.spacex.com/">spacex.com</a>.</b></p>',
                '<p>ТАСС благодарит за помощь в подготовке материала&nbsp;компанию «Наше кино».</p>',
                '<p>Книги, фильмы и сериалы, представленные в проекте, нам помогли выбрать пользователи социальной сети «Одноклассники».</p>',
            ]
        ]);

        $this->delete('{{%settings}}', ['key' => 'currentYear']);
        $this->delete('{{%settings}}', ['key' => 'projectTitle']);
        $this->delete('{{%settings}}', ['key' => 'logoUrl']);
        $this->delete('{{%settings}}', ['key' => 'mainPageImage']);
        $this->delete('{{%settings}}', ['key' => 'workedOnProject']);
        $this->delete('{{%settings}}', ['key' => 'usedMultimedia']);
        $this->delete('{{%settings}}', ['key' => 'sources']);
        $this->delete('{{%settings}}', ['key' => 'gratitude']);
        $this->delete('{{%settings}}', ['key' => 'additional']);

        $this->addColumn("{{%share}}", 'year_id', $this->integer()->notNull()->defaultValue(1));
        $this->addForeignKey("{share}_year_id_fkey", '{{%share}}', 'year_id', '{{%year}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey("{share}_year_id_fkey", '{{%share}}');
        $this->dropColumn("{{%share}}", 'year_id');

        $this->batchInsert('{{%settings}}', ['key', 'value', 'title', 'type'], [
            ['currentYear', 2018, 'Текущий год', 1],
            ['projectTitle', 'События 2018', 'Заголовок проекта', 1],
            ['logoUrl', 'http://tass.ru', 'Ссылка с логотипа', 1],
            ['mainPageImage', '', 'Заглавное изображение', 5],
            ['workedOnProject', '', 'Перечень работавших над проектом', 2],
            ['usedMultimedia', '', 'В материале использованы фотографии/видео', 2],
            ['sources', '', 'Источники', 2],
            ['gratitude', '', 'Блок благодарностей экспертам и организациям', 2],
            ['additional', '', 'Дополнительный текстовый блок', 2],
        ]);

        $this->dropTable('{{%year}}');
    }
}