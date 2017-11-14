<?php

use yii\db\Migration;

class m171111_145345_create_table_event_block extends Migration
{
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%event_block}}', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer()->notNull(),
            'model' => $this->string(100)->notNull(),
            'block_id' => $this->integer()->notNull(),
            'order' => $this->integer(),
            'anchor' => $this->string(20),
        ], $tableOptions);
        
        $this->addForeignKey("{event_block}_event_id_fkey", '{{%event_block}}', 'event_id', '{{%event}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown() {
        $this->dropTable('{{%event_block}}');
    }
}