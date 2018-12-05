<?php

use yii\db\Migration;

class m181204_113934_alter_table_share extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%share}}", 'image_tw', $this->string(255));
        $this->addColumn("{{%share}}", 'image_fb', $this->string(255));
    }

    public function safeDown() {
        $this->dropColumn("{{%share}}", 'image_tw');
        $this->dropColumn("{{%share}}", 'image_fb');
    }
}
