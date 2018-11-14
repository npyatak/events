<?php

use yii\db\Migration;

class m181015_093934_insert_into_settings extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->batchInsert('{{%settings}}', ['key', 'value', 'title', 'type'], [
            ['socials', '["fb","tw","ok","vk","tg"]', 'Соц.сети для "поделиться"', 3],
            ['smi2_code', '
                <h5>Новости партнеров</h5>
                <div class="news-partners-els">
                    <a class="news-partners-el" style="background-image:url(/images/more_events/Layer_86.jpg)">
                        <div>
                            <p>Запуск телескопа James Webb отложили до 2019 года</p>
                            <span>12 апреля</span>
                        </div>
                    </a>
                    <a class="news-partners-el" style="background-image:url(/images/more_events/Layer_86.jpg)">
                        <div>
                            <p>Запуск телескопа James Webb отложили до 2019 года</p>
                            <span>12 апреля</span>
                        </div>
                    </a>
                    <a class="news-partners-el" style="background-image:url(/images/more_events/Layer_86.jpg)">
                        <div>
                            <p>Запуск телескопа James Webb отложили до 2019 года</p>
                            <span>12 апреля</span>
                        </div>
                    </a>
                    <a class="news-partners-el" style="background-image:url(/images/more_events/Layer_86.jpg)">
                        <div>
                            <p>Запуск телескопа James Webb отложили до 2019 года</p>
                            <span>12 апреля</span>
                        </div>
                    </a>
                </div>
            ', 'Код СМИ2', 2],
        ]);
    }

    public function safeDown() {
        $this->delete('{{%settings}}', ['key' => 'socials']);
    }
}
