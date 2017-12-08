<?php

use yii\db\Migration;

class m171205_185435_create_table_block_tass_video extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_tass_video}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'image' => $this->string(255),
            'list_1' => $this->string(255),
            'list_2' => $this->string(255),
            'width' => $this->integer(),
            'height' => $this->integer(),
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_tass_video}}');
    }
}
