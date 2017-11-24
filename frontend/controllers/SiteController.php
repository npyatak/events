<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use jmartinez\yii\ics\ICS;

use common\models\Event;
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($year = null, $alias = null)
    {
        $dateNow = new \DateTime();
        $year = $year ? $year : Yii::$app->settings->get('currentYear', $dateNow->format('Y'));

        $query = Event::find()
            ->where(['between', 'timeline_date', \DateTime::createFromFormat('!Y', $year)->format('U'), \DateTime::createFromFormat('!Y', $year + 1)->format('U')])
            ->andWhere(['status' => Event::STATUS_ACTIVE]);
        if($alias) {
            $query->joinWith('categories');
            $query->andWhere(['category.alias' => $alias]);
        }
        $events = $query->all();

        return $this->render('index', [
            'events' => $events,
        ]);
    }

    public function actionEvent($id) {
        $event = $this->findEvent($id);
        // $event = Event::find()->joinWith('eventBlocks')->where(['event.id' => $id])->one();
        // print_r($event);exit;

        return $this->render('event', [
            'event' => $event,
        ]);
    }

    public function actionGc($id) {
        $event = $this->findEvent($id);
        //$dateStart = date(\DateTime::ATOM, time());
        //$dateEnd   = date(\DateTime::ATOM, time());

        /*https://www.google.com/calendar/render?action=TEMPLATE
            &text=Your+Event+Name
            &dates=20140127T224000Z/20140320T221500Z
            &details=For+details,+link+here:+http://www.example.com
            &location=Waldorf+Astoria,+301+Park+Ave+,+New+York,+NY+10022
            &sf=true
            &output=xml*/

        /*https://calendar.google.com/calendar/render?action=TEMPLATE
            &text=%D0%9F%D1%83%D1%82%D0%B8%D0%BD+%D0%B8+%D0%90%D1%81%D0%B0%D0%B4+%D0%BE%D0%B1%D1%81%D1%83%D0%B4%D0%B8%D0%BB%D0%B8+%D0%BF%D0%BE%D0%BB%D0%B8%D1%82%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%BE%D0%B5+%D1%83%D1%80%D0%B5%D0%B3%D1%83%D0%BB%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5+%D0%B2+%D0%A1%D0%B8%D1%80%D0%B8%D0%B8
            &dates=20171122T090000%2F20171122T0190000
            &details=http%3A%2F%2Fevents.local%2Fevent%3Fid%3D2
            &location=Waldorf%2BAstoria%2C%2B301%2BPark%2BAve%2B%2C%2BNew%2BYork%2C%2BNY%2B10022
            &sf=true
            &output=xml*/

        $dateStart = date('Ymd', time()).'T090000';
        $dateEnd   = date('Ymd', time()).'T190000';

        $url = 'https://calendar.google.com/calendar/render?'.http_build_query([
            'action' => 'TEMPLATE',
            'text' => $event->title,
            'dates' => $dateStart.'/'.$dateEnd,
            'details' => 'Подробности тут: '.$event->getUrl(true),
        ]);

        //print_r($url);exit;

        return $this->redirect($url);
    }

    public function actionIcs($id) {
        $event = $this->findEvent($id);
        $year = date('Y', $event->timeline_date);
        // print_r($year);
        // echo '<br>';
        // echo $event->view_date_1.'.'.$event->view_date_2;
        // exit;

        // switch ($event->view_date_type) {
        //     case Event::DATE_TYPE_DATE:
        //         $dateStart = \DateTime::createFromFormat('!d.mm.Y', $event->view_date_1.'.'.$event->view_date_2.'.'.$year)->format('U');
        //         $dateEnd = $dateStart;
        //         break;
        //     case Event::DATE_TYPE_MONTH_AND_YEAR:
        //         $dateTime = \DateTime::createFromFormat('!mm.Y', $event->view_date_1.'.'.$event->view_date_2);
        //         $dateStart = $dateTime->format('U');
        //         print_r($date->format('Y-m-t'));
        //         $dateEnd = $dateStart;
        //         break;
        //     case Event::DATE_TYPE_SEASON_AND_YEAR:
        //         $dateStart = \DateTime::createFromFormat('!d.mm.Y', $event->view_date_1.'.'.$event->view_date_2.'.'.$year)->format('U');
        //         $dateEnd = $dateStart;
        //         break;
            
        //     default:
        //         # code...
        //         break;
        // }
        /*BEGIN:VCALENDAR
        PRODID:-//%LONG_GLOBAL_NAME%//NONSGML %SHORT_GLOBAL_NAME%//RU
        VERSION:2.0
        METHOD:PUBLISH
        BEGIN:VEVENT
        UID:%EVENT_ID%
        DTSTART:%EVENT_START_DATE%T090000
        DTEND:%EVENT_END_DATE%T0190000
        DTSTAMP: %текущие дата и время в формате 20171113T134721%
        SUMMARY: %название события, см. пп.1.1.1%
        DESCRIPTION:%уточняется%
        BEGIN:VALARM
        TRIGGER:-PT1440M
        ACTION:DISPLAY
        DESCRIPTION:Напоминание о %название события, см. пп.1.1.1%
        END:VALARM
        END:VEVENT
        END:VCALENDAR*/

        $dateStart = date('Ymd', time()).'T090000';
        $dateEnd   = date('Ymd', time()).'T190000';

        $ics = new ICS([
            'dtstart' => $dateStart,
            'dtend' => $dateEnd,
            'description' => 'Напоминание о '.$event->title,
            'summary' => $event->title,
            'url' => $event->getUrl(true),
        ]);
        
        $ics->Download();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionShareCounts($url) {
        //$url = 'https://www.youtube.com/watch?v=Ao5jRFaHDO8';
        $data = [];

        //VK
        $str = @file_get_contents("http://vk.com/share.php?act=count&index=1&url=".urlencode($url));
        preg_match('#VK.Share.count\(1, ([0-9]+)\);#', $str, $matches);
        if(count($matches) > 1) {
            $data[] = ['soc' => 'vk', 'count' => intval($matches[1])];
        }
        //FB
        $str = @file_get_contents("http://graph.facebook.com/?id=".urlencode($url));
        $str = json_decode($str);
        $data[] = ['soc' => 'fb', 'count' => $str->share->share_count];

        //OK
        $str = @file_get_contents("https://connect.ok.ru/dk?st.cmd=extLike&uid=odklocs0&ref=".urlencode($url));
        //preg_match("#ODKL.updateCount('odklocs0','([0-9]+)\)');#", $str, $matches);
        $exp = explode(',', $str);
        if(count($exp) > 1) {
            $data[] = ['soc' => 'ok', 'count' => intval($exp[1])];
        }

        return json_encode($data);

    }

    protected function findEvent($id) {
        $model = Event::findOne($id);
        if ($model === null || ($model->status === Event::STATUS_INACTIVE && Yii::$app->user->isGuest)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}
