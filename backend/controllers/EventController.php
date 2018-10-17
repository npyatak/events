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
use backend\models\EditorModel;
use common\models\blocks\items\BlockGalleryImage;
use common\models\blocks\items\BlockFactItem;
use common\models\blocks\items\BlockCardItem;

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

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
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

            $loadBlockModels = $this->loadBlockModels($post);
            $blockModelsArray = $loadBlockModels['models'];

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

                        Yii::$app->session->setFlash("success", 'Данные успешно обновлены');

                        return $this->redirect(['update', 'id' => $model->id]);
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
    public function actionUpdate($id) {
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

        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            $transaction = Yii::$app->db->beginTransaction();

            $loadBlockModels = $this->loadBlockModels($post);
            $blockModelsArray = $loadBlockModels['models'];
            $blockIDs = $loadBlockModels['blockIDs'];

            $validationErrors = ArrayHelper::merge(
                ActiveForm::validateMultiple($blockModelsArray),
                ActiveForm::validate($model)
            );

            if(empty($validationErrors)) {
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

                        Yii::$app->session->setFlash("success", 'Данные успешно обновлены');

                        return $this->redirect(['update', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        $editorModel = EditorModel::find()->where(['model' => 'Event', 'model_id' => $id])->andWhere(['not', ['editor_id' => Yii::$app->user->id]])->orderBy('updated_at DESC')->one();
        if($editorModel !== null) {
            if($editorModel->updated_at + 120 < time()) {
                $editorModel->delete();
                $editorModel = null;
            } else {
                echo '<h2>Внимание! Событие в данный момент редактируется другим пользователем!</h2>';
                exit;
            }
        } 

        return $this->render('update', [
            'model' => $model,
            'blockModelsArray' => $blockModelsArray,
            'editorModel' => $editorModel,
        ]);
    }

    /*public function actionBlocks($id) {
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

        $post = Yii::$app->request->post();

        if (!empty($post)) {
            $transaction = Yii::$app->db->beginTransaction();

            $loadBlockModels = $this->loadBlockModels($post);
            $blockModelsArray = $loadBlockModels['models'];
            $blockIDs = $loadBlockModels['blockIDs'];
            
            $validationErrors = ActiveForm::validateMultiple($blockModelsArray);

            if(empty($validationErrors)) {
                try  {
                    $success = true;
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

                        return $this->redirect(['/event']);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } 

        return $this->render('blocks', [
            'blockModelsArray' => $blockModelsArray,
        ]);
    }*/

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/event']);
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

    public function actionAddGalleryImage($i, $key) {
        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_blocks/_block_gallery_image', [
                'model' => new BlockGalleryImage,
                'i' => $i,
                'key' => $key,
            ]);
        }
    }

    public function actionAddFactItem($i, $key) {
        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_blocks/_block_fact_item', [
                'model' => new BlockFactItem,
                'i' => $i,
                'key' => $key,
            ]);
        }
    }

    public function actionAddCardItem($i, $key) {
        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_blocks/_block_card_item', [
                'model' => new BlockCardItem,
                'i' => $i,
                'key' => $key,
            ]);
        }
    }

    protected function loadBlockModels($post) {
        $blockIDs = [];
        $blockModelsArray = [];

        foreach ($post as $key => $blockDataArray) {
            $class = 'common\models\blocks\\'.$key;
            if(class_exists($class)) {
                foreach ($blockDataArray as $i => $blockData) {
                    if(isset($blockData['id'])) {
                        $blockIDs[$key][] = $blockData['id'];
                        $blockModel = $class::findOne($blockData['id']);
                    } else {
                        $blockModel = new $class;
                    }
                    $blockModel->attributes = $blockData;

                    if(isset($blockModel->itemsModelName)) {
                        $blockModel->loadItems($post[$blockModel->itemsModelName][$i]);
                    }

                    $blockModelsArray[$i] = $blockModel;
                    $blockModel = null;
                }
            }
        }

        return ['models' => $blockModelsArray, 'blockIDs' => $blockIDs];
    }

    public function actionOrder() {
        $post = Yii::$app->request->post();
        if(Yii::$app->request->isAjax && isset($post) && !empty($post['EventBlock'])) {
            foreach ($post['EventBlock'] as $id => $eventBlock) {
                $eventBlock = EventBlock::findOne($id);
                $eventBlock->order = $post['EventBlock'][$id]['order'];
                $eventBlock->save(false, ['order']);
            }

            return 'success';
        }
    }

    public function actionEditorModel($id) {
        if(Yii::$app->request->isAjax) {
            $em = EditorModel::find()->where(['model' => 'Event', 'model_id' => $id, 'editor_id' => Yii::$app->user->id])->one();
            if($em === null) {
                $em = new EditorModel;
                $em->editor_id = Yii::$app->user->id;
                $em->model_id = $id;
                $em->model = 'Event';
            }
            $em->updated_at = time();

            $em->save();
            return $em->updated_at;
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
        $result = [];

        foreach($array1 as $key => $val) {
            if(is_array($val) && isset($array2[$key])) {
                $result[$key] = $this->check_diff_multi($val, $array2[$key]);
            } else {
                if(!in_array($val, $array2)) {
                    $result[] = $val;
                }
            }
        }

        return $result;
    }
}
