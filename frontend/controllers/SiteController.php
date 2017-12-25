<?php
namespace frontend\controllers;

use Yii;
use yii\helpers\Url;
use yii\base\InvalidParamException;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use jmartinez\yii\ics\ICS;

use common\models\Event;
use common\models\Category;
use common\models\Share;

class SiteController extends Controller
{
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

    public function actionIndex($month = null, $category = null)
    {
        $dateNow = new \DateTime();
        $year = (int)Yii::$app->settings->get('currentYear', $dateNow->format('Y'));

        $query = Event::find()
            ->where(['between', 'date', \DateTime::createFromFormat('!Y', $year)->format('U'), \DateTime::createFromFormat('!Y', $year + 1)->format('U')])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->andWhere(['show_on_main' => 1])
            ->joinWith('categories');

        $events = [];

        foreach ($query->orderBy('value_index DESC')->all() as $e) {
            $events[date('n', $e->date)][] = $e;
        }

        if(Yii::$app->request->isAjax) {
            return $this->renderAjax('_months', [
                'events' => $events,
            ]);
        }

        if(!Yii::$app->cacheFrontend->get('shares')) {
            Yii::$app->cacheFrontend->set('shares', Share::find()->all(), 3600*3);
        }

        return $this->render('index', [
            'events' => $events,
            'month' => $month,
            'category' => $category,
            'year' => $year,
            'categories' => Category::find()->all(),
            'shares' => Yii::$app->cacheFrontend->get('shares') ? Yii::$app->cacheFrontend->get('shares') : Share::find()->all(),
        ]);
    }

    public function actionMonth($id, $category = null)
    {
        $month = $id;
        $dateNow = new \DateTime();
        $year = (int)Yii::$app->settings->get('currentYear', $dateNow->format('Y'));

        $query = Event::find()
            ->where(['between', 'date', \DateTime::createFromFormat('!Y.n', $year.'.'.$month)->format('U'), 
                \DateTime::createFromFormat('!Y.n', ($year + 1).'.'.$month)->format('U')])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->joinWith('categories');

        $events = $query->orderBy('value_index DESC')->all();

        return $this->render('month', [
            'events' => $events,
            'share' => Share::find()->where(['month' => $month])->one(),
            'category' => $category,
            'year' => $year,
            'month' => $month,
        ]);
    }

    public function actionEvent($alias) {
        $event = $this->findEvent($alias);
        $nextEvent = null;
        $prevEvent = null;

        $date = new \DateTime;
        $date->setTimestamp($event->date);
        $date2 = clone $date;
        $firstDay = $date->modify('first day of last month')->format('U');
        $lastDay = $date2->modify('last day of next month')->format('U');

        $query = Event::find()
            ->select(['id', 'date'])
            ->where(['between', 'date', $firstDay, $lastDay])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->andWhere(['show_on_main' => 1])
            ->orderBy('value_index DESC')
            ->asArray();

        $eventsArr = [];

        foreach ($query->all() as $e) {
            $eventsArr[date('n', $e['date'])][] = $e['id'];
        }

        ksort($eventsArr);
        $eventIds = [];
        foreach ($eventsArr as $m => $eIds) {
            foreach ($eIds as $eId) {
                $eventIds[] = $eId;
            }
        }

        $eventKey = array_search($event->id, $eventIds);
        if($eventKey && isset($eventIds[$eventKey - 1])) {
            $prevEvent = Event::findOne($eventIds[$eventKey - 1]);
        }
        if($eventKey && isset($eventIds[$eventKey + 1])) {
            $nextEvent = Event::findOne($eventIds[$eventKey + 1]);
        }

        return $this->render('event', [
            'event' => $event,
            'nextEvent' => $nextEvent,
            'prevEvent' => $prevEvent,
        ]);
    }

    public function actionGc($alias) {
        $event = $this->findEvent($alias);
        /*https://calendar.google.com/calendar/render?action=TEMPLATE
            &text=%D0%9F%D1%83%D1%82%D0%B8%D0%BD+%D0%B8+%D0%90%D1%81%D0%B0%D0%B4+%D0%BE%D0%B1%D1%81%D1%83%D0%B4%D0%B8%D0%BB%D0%B8+%D0%BF%D0%BE%D0%BB%D0%B8%D1%82%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%BE%D0%B5+%D1%83%D1%80%D0%B5%D0%B3%D1%83%D0%BB%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5+%D0%B2+%D0%A1%D0%B8%D1%80%D0%B8%D0%B8
            &dates=20171122T090000%2F20171122T0190000
            &details=http%3A%2F%2Fevents.local%2Fevent%3Fid%3D2
            &location=Waldorf%2BAstoria%2C%2B301%2BPark%2BAve%2B%2C%2BNew%2BYork%2C%2BNY%2B10022
            &sf=true
            &output=xml*/

        $dateStart = date('Ymd', $event->date).'T090000';
        $dateEnd   = date('Ymd', $event->date).'T190000';

        $url = 'https://calendar.google.com/calendar/render?'.http_build_query([
            'action' => 'TEMPLATE',
            'text' => $event->title,
            'dates' => $dateStart.'/'.$dateEnd,
            'details' => 'Подробности тут: '.$event->getUrl(true),
        ]);

        return $this->redirect($url);
    }

    public function actionIcs($alias) {
        $event = $this->findEvent($alias);

        $dateStart = date('Ymd', $event->date).'T090000';
        $dateEnd   = date('Ymd', $event->date).'T190000';

        $ics = new ICS([
            'dtstart' => $dateStart,
            'dtend' => $dateEnd,
            'description' => $event->socials_text.' '.$event->getUrl(true),
            'summary' => $event->title,
            'url' => $event->getUrl(true),
        ]);
        
        $ics->Download();
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

    protected function findEvent($alias) {
        $model = Event::find()->where(['alias' => $alias])->one();
        if ($model === null || ($model->status === Event::STATUS_INACTIVE && Yii::$app->user->isGuest)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }
}
