<?php

use yii\db\Migration;

class m171120_145335_create_table_block_card extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_card}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'preview' => $this->string(255),
            'icon' => $this->string(255),

            'link' => $this->string(255),
            'text' => $this->text(),     
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_card}}');
    }
}
/*
1) "Заголовок" - инпут без возможности настраивать стили
2) "Подзаголовок" - инпут без возможности настраивать стили
3) "Иконка" - не обязательно для заполнения
4) "Цвет нижнего разделителя"
5) "Заголовок к верхнему разделителю" - инпут без возможности настраивать стили - по умолчанию "Важные факты"
4) Кнопка "Добавить кат" Работает аналогично цифрофакту Шаг 2 создания статьи. Блок "Цифрофакт"*/