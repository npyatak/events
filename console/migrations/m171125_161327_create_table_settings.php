<?php

use yii\db\Migration;

class m171125_161327_create_table_settings extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(100)->notNull(),
            'value' => $this->text(),
            'title' => $this->string(100)->notNull(),
            'type' => $this->integer(1)->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%settings}}', ['key', 'value', 'title', 'type'], [
            ['currentYear', 2017, 'Текущий год', 1],
            ['projectTitle', 'События 2018', 'Заголовок проекта', 1],
            ['logoUrl', 'http://tass.ru', 'Ссылка с логотипа', 1],
            ['mainPageImage', '', 'Заглавное изображение', 5],
            ['workedOnProject', '', 'Перечень работавших над проектом', 2],
            ['usedMultimedia', '', 'В материале использованы фотографии/видео', 2],
            ['sources', '', 'Источники', 2],
            ['gratitude', '', 'Блок благодарностей экспертам и организациям', 2],
            ['additional', '', 'Дополнительный текстовый блок', 2],
            ['proviso', 'ТАСС информационное агентство (св-во о регистрации СМИ № 03247 выдано 02 апреля 1999 г. Государственным комитетом Российской Федерации по печати). Отдельные публикации могут содержать информацию, не предназначенную для пользователей до 16 лет.', 'Текст оговорки', 2]
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%settings}}');
    }
}
