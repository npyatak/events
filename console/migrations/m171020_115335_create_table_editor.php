<?php

use yii\db\Migration;

class m171020_115335_create_table_editor extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%editor}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'name' => $this->string(255),
            'surname' => $this->string(255),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'role' => $this->integer(1)->notNull()->defaultValue(1),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        //email/login: tass@tass.ru, имя: Администратор, пароль: qwerty
        $this->batchInsert('{{%editor}}', ['login', 'name', 'password_hash', 'auth_key', 'email', 'role', 'created_at', 'updated_at'], [
            ['tass@tass.ru', 'Администратор', '$2y$13$sOp6yzJtXKp6JcxX4Wpoy.t2HhpjUPDpr0nG9lD3JtKqCoXkCwDZ6', 'sdsadasd', 'tass@tass.ru', 5, time(), time()],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%editor}}');
    }
}
