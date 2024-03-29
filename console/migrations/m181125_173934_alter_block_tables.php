<?php

use yii\db\Migration;

class m181125_173934_alter_block_tables extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->alterColumn('{{%block_image}}', 'source', $this->string());
        $this->alterColumn('{{%block_gallery_image}}', 'image', $this->string());
    }

    public function safeDown() {
        $this->alterColumn('{{%block_image}}', 'source', $this->string()->notNull());
        $this->alterColumn('{{%block_gallery_image}}', 'image', $this->string()->notNull());
    }
}
