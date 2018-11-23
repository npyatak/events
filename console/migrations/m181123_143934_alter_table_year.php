<?php

use yii\db\Migration;

class m181123_143934_alter_table_year extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->addColumn("{{%year}}", 'used_multimedia_label', $this->string()->defaultValue('В проекте использованы фотографии'));
    }

    public function safeDown() {
        $this->dropColumn("{{%year}}", 'used_multimedia_label');
    }
}
