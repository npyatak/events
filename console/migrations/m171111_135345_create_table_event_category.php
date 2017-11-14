<?php

use yii\db\Migration;

class m171111_135345_create_table_event_category extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%event_category}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{event_category}_event_id_fkey", '{{%event_category}}', 'event_id', '{{%event}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey("{event_category}_category_id_fkey", '{{%event_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropForeignKey('{event_category}_event_id_fkey', '{{%event_category}}');
        $this->dropForeignKey('{event_category}_category_id_fkey', '{{%event_category}}');

        $this->dropTable('{{%event_category}}');
    }
}