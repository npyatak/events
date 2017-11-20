<?php

use yii\db\Migration;

class m171125_161327_create_table_share extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%share}}', [
            'id' => $this->primaryKey(),
            'month' => $this->integer(2),
            'title' => $this->string(255)->notNull(),
            'image' => $this->string(255)->notNull(), 
            'text' => $this->string(255)->notNull(), 
            'twitter' => $this->string(255)->notNull(),         
        ], $tableOptions);

        $this->batchInsert('{{%share}}', ['month', 'title', 'image', 'text', 'twitter'], [
            [null, '', '', '', ''],
            [1, '', '', '', ''],
            [2, '', '', '', ''],
            [3, '', '', '', ''],
            [4, '', '', '', ''],
            [5, '', '', '', ''],
            [6, '', '', '', ''],
            [7, '', '', '', ''],
            [8, '', '', '', ''],
            [9, '', '', '', ''],
            [10, '', '', '', ''],
            [11, '', '', '', ''],
            [12, '', '', '', ''],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%share}}');
    }
}