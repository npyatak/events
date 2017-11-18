<?php

use yii\db\Migration;

class m171117_155335_create_table_block_gallery_image extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_gallery_image}}', [
            'id' => $this->primaryKey(),
            'block_gallery_id' => $this->integer()->notNull(),
            'image' => $this->string(255)->notNull(),
            'title' => $this->string(255),
            'copyright' => $this->string(255),
        ], $tableOptions);

        $this->addForeignKey("{block_gallery_image}_block_gallery_id_fkey", '{{%block_gallery_image}}', 'block_gallery_id', '{{%block_gallery}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%block_gallery_image}}');
    }
}
