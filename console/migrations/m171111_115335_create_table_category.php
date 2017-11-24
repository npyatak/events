<?php

use yii\db\Migration;

class m171111_115335_create_table_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'alias' => $this->string(100)->notNull(),
            'color' => $this->string(7),
        ], $tableOptions);

        $this->batchInsert('{{%category}}', ['title', 'alias'], [
            ['Премьеры', 'premiere'],
            ['Объекты', 'object'],
            ['События', 'event'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}
