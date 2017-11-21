<?php
namespace common\fixtures;

use Yii;
use common\models\EventBlock;
use yii\test\ActiveFixture;

class EventBlockFixture extends ActiveFixture
{
    public $modelClass = 'common\models\EventBlock';
    public $depends = ['common\fixtures\EventFixture'];

    public function load()
    {
        $this->resetTable();
        $this->data = [];
        $table = $this->getTableSchema();
        foreach ($this->getData() as $alias => $row) {
            if(isset($row['block'])) {
                $block = $row['block'];
                unset($row['block']);

                $class = 'common\models\blocks\\'.$row['model'];
            }

            $primaryKeys = $this->db->schema->insert($table->fullName, $row);
            $this->data[$alias] = array_merge($row, $primaryKeys);

            if(isset($block)) {
                $model = new $class;
                $model->attributes = $block;
                $model->order = $row['order'];

                if(isset($model->itemsModelName) && isset($block['items'])) {
                    $model->loadItems($block['items']);
                }

                if(!$model->save()) {
                    print_r($model->errors);
                }
            }
        }
        
    }
}