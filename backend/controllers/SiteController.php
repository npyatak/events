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
                        'actions' => ['logout', 'index', 'ckeditor-image-upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {            
        if ($action->id == 'ckeditor-image-upload') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
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

    public function actionCkeditorImageUpload()
    {
        $funcNum = $_REQUEST['CKEditorFuncNum'];
        $message = null;

        if($_FILES['upload']) {
            if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name']))) {
                $message = 'Пожалуйста, выберите изображение';
            } else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 5*1024*1024) {
                $message = 'Размер не должен превышать 5мб';
            } else if ( ($_FILES['upload']["type"] != "image/jpg") 
                && ($_FILES['upload']["type"] != "image/jpeg") 
                && ($_FILES['upload']["type"] != "image/png"))
            {
                $message = Yii::t('app', "The image type should be JPG , JPEG Or PNG.");
            } else if (!is_uploaded_file($_FILES['upload']["tmp_name"])) {
                $message = 'Ошибка. Попробуйте позже.';
            } else {
                //$extension = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);

                $name = $_FILES['upload']['name']; 

                $path = __DIR__ . '/../../frontend/web';
                $folder = '/uploads/ckeditor_images/';  

                if(!file_exists($path.$folder)) {
                    mkdir($path.$folder, 0775, true);
                }

                move_uploaded_file($_FILES['upload']['tmp_name'], $path.$folder.$name);

                if(isset(Yii::$app->webdavFs)) {                    
                    $content = file_get_contents($path.$folder.$name);
                    unlink($path.$folder.$name);

                    Yii::$app->webdavFs->put('events/'.$folder.$name, $content);
                }

                $url = Yii::$app->image->getImageUrl($folder.$name);
            }

            echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'
                .$funcNum.'", "'.$url.'", "'.$message.'" );</script>';
        }
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

        //$content = file_get_contents('http://192.168.25.62/events/uploads/90_main_page_image_url_540x620.jpg');
        //Yii::$app->webdavFs->put('/events/test/123.jpg', $content);
        Yii::$app->webdavFs->delete('/events/uploads/159_main_page_mobile_image_url_290x190.svg');
        // if(Yii::$app->webdavFs->delete('/events/test')) {
        //     print_r(Yii::$app->webdavFs->delete('events/test/'));
        // }
        //Yii::$app->webdavFs->createDir('/events/test/');

        // if(Yii::$app->webdavFs->has('/events/images/ds')) {
        //     echo '2112';
        //     //Yii::$app->webdavFs->rename('events/images/123/telescopes-review-ai.jpg', 'events/images/123/telescopes.jpg');
        // }
        //Yii::$app->webdavFs->delete('events/uploads/1131d8358f6ad0910dfed66c911673e4.png');
        //print_r(Yii::$app->webdavFs->listContents('test/', true));
        echo '<pre>';
        print_r(Yii::$app->webdavFs->listContents('/events/images/xfiles', true));
        echo '</pre>';
        //print_r(Yii::$app->webdavFs->getMetadata('events/images'));
        //print_r(Yii::$app->webdavFs->listContents('academy/images', true));

    }

    public function actionElfinderTest()
    {
        return $this->render('elfinder-test');
    }
}
