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
            'line_color' => $this->string(7),
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_card}}');
    }
}