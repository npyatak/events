<?php

use yii\db\Migration;

class m171119_165335_create_table_block_fact_item extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_fact_item}}', [
            'id' => $this->primaryKey(),
            'block_fact_id' => $this->integer()->notNull(),
            'type' => $this->integer(1)->notNull()->defaultValue(1),
            'number' => $this->string(255),
            'capture' => $this->string(255),
            'link' => $this->string(255),
            'text' => $this->text(),
            'border_top' => $this->integer(1),
            'border_bottom' => $this->integer(1),
        ], $tableOptions);

        $this->addForeignKey("{block_fact_item}_block_fact_id_fkey", '{{%block_fact_item}}', 'block_fact_id', '{{%block_fact}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%block_fact_item}}');
    }
}