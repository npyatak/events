<?php

namespace common\models\blocks;

use Yii;

class BlockCutEnd extends Block
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block_cut_end}}';
    }

    public static function getBlockName() {
        return '- кат окончание';
    }
}