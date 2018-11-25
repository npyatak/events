<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\forms\LoginForm;

use common\models\Settings;
use common\models\search\SettingsSearch;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'web-dav-test', 'elfinder-test'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return Yii::$app->runAction('event/index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionWebDavTest()
    {
        //print_r(Yii::$app->webdavFs->getMetadata('events/images/aaaaa'));
        //print_r(Yii::$app->webdavFs->getMetadata('events/bbbbb'));

        $root = __DIR__ . '/../../frontend/web';
        $event = \common\models\Event::findOne(76);
        $attribute = 'origin_image';

        $content = file_get_contents('http://192.168.25.62/events/uploads/90_main_page_image_url_540x620.jpg');
        //Yii::$app->webdavFs->put('/events/test/123.jpg', $content);

        if(Yii::$app->webdavFs->delete('/events/test')) {
            print_r(Yii::$app->webdavFs->delete('events/test/'));
        }
        //Yii::$app->webdavFs->createDir('/events/test/');

        // if(Yii::$app->webdavFs->has('/events/images/ds')) {
        //     echo '2112';
        //     //Yii::$app->webdavFs->rename('events/images/123/telescopes-review-ai.jpg', 'events/images/123/telescopes.jpg');
        // }
        //Yii::$app->webdavFs->delete('events/uploads/1131d8358f6ad0910dfed66c911673e4.png');
        //print_r(Yii::$app->webdavFs->listContents('test/', true));
        echo '<pre>';
        print_r(Yii::$app->webdavFs->listContents('/events', true));
        echo '</pre>';
        //print_r(Yii::$app->webdavFs->getMetadata('events/images'));
        //print_r(Yii::$app->webdavFs->listContents('academy/images', true));

    }

    public function actionElfinderTest()
    {
        return $this->render('elfinder-test');
    }
}
