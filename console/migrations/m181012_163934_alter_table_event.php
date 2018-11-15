<?php

use yii\db\Migration;

class m181012_163934_alter_table_event extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%event}}", 'copyright', $this->text());
        $this->addColumn("{{%event}}", 'short_title', $this->string(255));
        $this->addColumn("{{%event}}", 'meta_title', $this->string(255));
        $this->addColumn("{{%event}}", 'meta_description', $this->string(255));
        $this->addColumn("{{%event}}", 'redirect_url', $this->string(255));
    }

    public function safeDown() {
        $this->dropColumn("{{%event}}", 'copyright');
        $this->dropColumn("{{%event}}", 'short_title');
        $this->dropColumn("{{%event}}", 'meta_title');
        $this->dropColumn("{{%event}}", 'meta_description');
        $this->dropColumn("{{%event}}", 'redirect_url');
    }
}
