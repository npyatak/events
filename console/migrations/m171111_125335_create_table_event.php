<?php

use yii\db\Migration;

class m171111_125335_create_table_event extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'leading_text' => $this->string(),
            'view_date' => $this->string(100),
            'timeline_date' => $this->integer()->notNull(),
            'socials_image_url' => $this->string(255)->notNull(),
            'image_url' => $this->string(255)->notNull(),
            'socials_text' => $this->string(),
            'show_on_main' => $this->integer(1)->notNull()->defaultValue(0),
            'value_index' => $this->integer(2)->notNull()->defaultValue(9),
            'similar' => $this->string(),
            'content' => $this->text(),

            'status' => $this->integer(1)->notNull()->defaultValue(5),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%event}}');
    }
}
