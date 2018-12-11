<?php

use yii\db\Migration;

class m181211_113934_add_watermark_type extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%event}}", 'watermark_type', $this->integer(1));
        $this->addColumn("{{%share}}", 'watermark_type', $this->integer(1));
    }

    public function safeDown() {
        $this->dropColumn("{{%event}}", 'watermark_type');
        $this->dropColumn("{{%share}}", 'watermark_type');
    }
}
