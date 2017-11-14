<?php

use yii\db\Migration;

class m171111_155335_create_table_block_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_image}}', [
            'id' => $this->primaryKey(),
            'source' => $this->string()->notNull(),
            'float' => $this->string(10),
            'url' => $this->string(),
            'show_fullscreen' => $this->integer(1)->notNull()->defaultValue(0),
            'copyright_text' => $this->string(),
            'copyright_color' => $this->string(7),
            'text' => $this->string(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%block_image}}');
    }
}
