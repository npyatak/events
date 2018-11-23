<?php

use yii\db\Migration;

class m181121_153934_alter_table_event extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%event}}", 'origin_image', $this->string(255));
        $this->addColumn("{{%event}}", 'main_page_mobile_image_url', $this->string(255));
    }

    public function safeDown() {
        $this->dropColumn("{{%event}}", 'main_page_mobile_image_url');
        $this->dropColumn("{{%event}}", 'origin_image');
    }
}
