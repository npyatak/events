<?php

use yii\db\Migration;

class m171120_135335_create_table_block_cut extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_cut}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'preview' => $this->string(255),
            'text' => $this->text(),
            'text_show' => $this->string(255),
            'text_hide' => $this->string(255),
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_cut}}');
    }
}
