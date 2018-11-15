<?php

use yii\db\Migration;

class m171120_165335_create_table_block_card_item extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_card_item}}', [
            'id' => $this->primaryKey(),
            'block_card_id' => $this->integer()->notNull(),
            'icon' => $this->integer(1),
            'title' => $this->string(255),
            'text' => $this->text(),
        ], $tableOptions);

        $this->addForeignKey("{block_card_item}_block_card_id_fkey", '{{%block_card_item}}', 'block_card_id', '{{%block_card}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%block_card_item}}');
    }
}