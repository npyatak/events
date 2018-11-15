<?php

use yii\db\Migration;

class m181013_100335_create_table_editor_model extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%editor_model}}', [
            'id' => $this->primaryKey(),
            'editor_id' => $this->integer()->notNull(),
            'model' => $this->string(25)->notNull(),
            'model_id' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey("{editor_model}_editor_id_fkey", '{{%editor_model}}', 'editor_id', '{{%editor}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('{{%editor_model}}');
    }
}
