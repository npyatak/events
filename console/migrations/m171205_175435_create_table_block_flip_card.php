<?php

use yii\db\Migration;

class m171205_175435_create_table_block_flip_card extends Migration {
    
    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block_flip_card}}', [
            'id' => $this->primaryKey(),
            'width' => $this->integer(4),
            'height' => $this->integer(4),
            'text_front' => $this->text(),          
            'text_back' => $this->text(),  
            'image_front' => $this->string(255),        
            'image_back' => $this->string(255),      
            'control_text' => $this->string(255),  
            'control_text_back' => $this->string(255),
            'capture_front' => $this->string(255),      
            'capture_back' => $this->string(255),      
        ], $tableOptions);

    }

    public function safeDown() {
        $this->dropTable('{{%block_flip_card}}');
    }
}
