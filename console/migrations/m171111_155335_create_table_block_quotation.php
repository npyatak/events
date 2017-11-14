<?php

use yii\db\Migration;

class m171111_155335_create_table_block_quotation extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_quotation}}', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'by_line' => $this->string(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%block_quotation}}');
    }
}
