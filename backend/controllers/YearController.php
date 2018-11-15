<?php

namespace backend\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

use common\models\Year;
use common\models\Share;
use common\models\Event;
use common\models\search\YearSearch;

/**
 * YearController implements the CRUD actions for Year model.
 */
class YearController extends CController
{  
    /*public function beforeAction($action) {
        if(!Yii::$app->user->identity->canAdmin()) {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }

        return parent::beforeAction($action);
    }*/

    public function actionIndex()
    {
        $searchModel = new YearSearch();
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

    public function actionCreate()
    {
        $model = new Year();
        $lastYear = Year::find()->orderBy('id DESC')->one();
        if($lastYear) {
            $model->worked_on_project = $lastYear->worked_on_project;
            $model->used_multimedia = $lastYear->used_multimedia;
            $model->sources = $lastYear->sources;
            $model->gratitude = $lastYear->gratitude;
            $model->additional = $lastYear->additional;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            for ($i=0; $i <= 12; $i++) { 
                $share = new Share;
                $share->month = $i == 0 ? null : $i;
                $share->year_id = $model->id;
                $share->title = 'Самые ожидаемые и обсуждаемые события '.($i ? Event::getMonth($i, true) : '');
                $share->text = 'Кажется,';
                $share->twitter = 'Проект "'.$model->title.'". Самые ожидаемые и обсуждаемые события '.($i ? Event::getMonth($i, true) : '');
                $share->image = '/images/shar/FBlogo1200.png';

                $share->save();
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Year model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Year model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Year the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Year::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
