<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

use common\models\Event;
use common\models\search\EventSearch;
use common\models\EventBlock;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends CController
{  

    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();
        $model->loadDefaultValues();
        $blockModelsArray = [];

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();

            $i = 0;
            foreach ($post as $key => $blockDataArray) {
                $class = 'common\models\blocks\\'.$key;
                if(class_exists($class)) {
                    foreach ($blockDataArray as $blockData) {
                        $blockModel = new $class;
                        $blockModel->attributes = $blockData;

                        $blockModelsArray[$i] = $blockModel;
                        $i++;
                    }
                }
            }

            $validationArr = ArrayHelper::merge(
                ActiveForm::validateMultiple($blockModelsArray),
                ActiveForm::validate($model)
            );

            if(empty($validationArr)) {
                try  {
                    $success = $model->save();
                    foreach ($blockModelsArray as $key => $blockModel) {
                        if($success) {
                            $success = $blockModel->save();

                            $eventBlock = new EventBlock;
                            $eventBlock->event_id = $model->id;
                            $eventBlock->model = $blockModel->formName();
                            $eventBlock->block_id = $blockModel->id;
                            $eventBlock->order = $blockModel->order;
                            $eventBlock->anchor = $blockModel->anchor;

                            $eventBlock->save();
                        }
                    }

                    if($success) {
                        $transaction->commit();

                        return $this->redirect(['index']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 

        return $this->render('create', [
            'model' => $model,
            'blockModelsArray' => $blockModelsArray,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $blockIDsOld = [];
        $blockModelsArray = [];

        foreach ($model->eventBlocks as $eventBlock) {
            $blockIDsOld[$eventBlock->model][] = $eventBlock->block_id;
            $block = $eventBlock->block;
            $block->order = $eventBlock->order;
            $block->anchor = $eventBlock->anchor;
            $blockModelsArray[] = $block;
        }

        $blockIDs = [];

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $blockModelsArray = [];
            $transaction = Yii::$app->db->beginTransaction();

            $i = 0;
            foreach ($post as $key => $blockDataArray) {
                $class = 'common\models\blocks\\'.$key;
                if(class_exists($class)) {
                    foreach ($blockDataArray as $blockData) {
                        if(isset($blockData['id'])) {
                            $blockIDs[$key][] = $blockData['id'];
                            $blockModel = $class::findOne($blockData['id']);
                        } else {
                            $blockModel = new $class;
                        }
                        $blockModel->attributes = $blockData;

                        $blockModelsArray[$i] = $blockModel;
                        $i++;
                        $blockModel = null;
                    }
                }
            }
            
            $validationArr = ArrayHelper::merge(
                ActiveForm::validateMultiple($blockModelsArray),
                ActiveForm::validate($model)
            );

            if(empty($validationArr)) {
                try  {
                    $success = $model->save();
                    foreach ($blockModelsArray as $key => $blockModel) {
                        if($success) {
                            $success = $blockModel->save();

                            if($blockModel->eventBlock === null) {
                                $eventBlock = new EventBlock;
                                $eventBlock->event_id = $model->id;
                                $eventBlock->model = $blockModel->formName();
                                $eventBlock->block_id = $blockModel->id;
                            } else {
                                $eventBlock = $blockModel->eventBlock;
                            }

                            $eventBlock->order = $blockModel->order;
                            $eventBlock->anchor = $blockModel->anchor;

                            $eventBlock->save();
                        }
                    }

                    foreach ($this->check_diff_multi($blockIDsOld, $blockIDs) as $key => $ids) {
                        foreach ($ids as $id) {
                            $class = 'common\models\blocks\\'.$key;
                            $class::findOne($id)->delete();
                        }
                    }

                    if($success) {
                        $transaction->commit();

                        return $this->redirect(['index']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 

        return $this->render('update', [
            'model' => $model,
            'blockModelsArray' => $blockModelsArray,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddBlock($blockClass, $i) {
        if(Yii::$app->request->isAjax) {
            $model = new $blockClass;

            return $this->renderAjax('_blocks/template', [
                'model' => $model,
                'view' => $model->view,
                'i' => $i,
            ]);
        }
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function check_diff_multi($array1, $array2) {
        $result = array();
        foreach($array1 as $key => $val) {
             if(isset($array2[$key])){
               if(is_array($val) && $array2[$key]){
                   $result[$key] = $this->check_diff_multi($val, $array2[$key]);
               }
           } else {
               $result[$key] = $val;
           }
        }

        return $result;
    }
}
