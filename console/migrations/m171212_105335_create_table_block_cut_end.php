<?php

use yii\db\Migration;

class m171212_105335_create_table_block_cut_end extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_cut_end}}', [
            'id' => $this->primaryKey(),
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_cut_end}}');
    }
}
