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
use common\models\Year;
use common\models\Share;

class SiteController extends Controller
{
    public $yearModel;
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

    public function actionIndex($month = null, $category = null, $year = null)
    {
        if(in_array($_SERVER['REQUEST_URI'], ['/index', '/'.$year.'/events', '/'.$year.'/events/'])) {
            if($year) {
                return Yii::$app->getResponse()->redirect(Url::toRoute(['site/index', 'year' => $year]), 301);
            }
            return Yii::$app->getResponse()->redirect(Url::home(), 301);
        }

        $dateNow = new \DateTime();
        if(!$month) {
            $month = $dateNow->format('n');
        }

        $yearModel = $year ? $this->findYear($year) : $this->findYear();
        if($yearModel === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->yearModel = $yearModel;
        $otherYears = Year::find()->where(['show_on_main' => 1])->andWhere(['not', ['id' => $yearModel->id]])->all();

        $query = Event::find()
            ->where(['between', 'date', \DateTime::createFromFormat('!Y', $yearModel->number)->format('U'), \DateTime::createFromFormat('!Y', $yearModel->number + 1)->format('U')])
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

        $shares = Share::find()->where(['year_id' => $yearModel->id])->orderBy('month')->all();

        return $this->render('index', [
            'events' => $events,
            'month' => $month,
            'category' => $category,
            'categories' => Category::find()->all(),
            'shares' => $shares,
            'otherYears' => $otherYears,
        ]);
    }

    public function actionMonth($id, $category = null, $year = null)
    {
        $month = $id;
        $dateNow = new \DateTime();
        $this->yearModel = $this->findYear($year);

        $query = Event::find()
            ->where(['between', 'date', \DateTime::createFromFormat('!Y.n', $this->yearModel->number.'.'.$month)->format('U'), 
                \DateTime::createFromFormat('!Y.n', ($this->yearModel->number + 1).'.'.$month)->format('U')])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->joinWith('categories');

        $events = $query->orderBy('value_index DESC')->all();

        return $this->render('month', [
            'events' => $events,
            'share' => Share::find()->where(['month' => $month])->one(),
            'category' => $category,
            'month' => $month,
        ]);
    }

    public function actionEvent($alias, $year = null) 
    {      
        $event = $this->findEvent($alias);
        $nextEvent = null;
        $prevEvent = null;

        $eventYear = date('Y', $event->date);
        if($eventYear != $year) {
            return $this->redirect(['event', 'alias' => $alias, 'year' => $eventYear]);
        }
        $this->yearModel = $this->findYear($year);

        if($event->redirect_url) {
            return $this->redirect($event->redirect_url);
        }

        $date = new \DateTime;
        $date->setTimestamp($event->date);
        $date2 = clone $date;
        $firstDay = $date->modify('first day of last month')->format('U');
        $lastDay = $date2->modify('last day of next month')->format('U');

        $query = Event::find()
            ->where(['between', 'date', $firstDay, $lastDay])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->andWhere(['show_on_main' => 1])
            ->orderBy('value_index DESC')
            ->asArray();

        $eventsArr = [];

        foreach ($query->all() as $e) {
            $eventsArr[date('n', $e['date'])][] = $e;
        }

        ksort($eventsArr);
        $eventIds = [];
        foreach ($eventsArr as $m => $eIds) {
            foreach ($eIds as $eId) {
                $eventIds[] = $eId['id'];
            }
        }

        $eventKey = array_search($event->id, $eventIds);
        if($eventKey !== null && isset($eventIds[$eventKey - 1])) {
            $prevEvent = Event::findOne($eventIds[$eventKey - 1]);
        }
        if($eventKey !== null && isset($eventIds[$eventKey + 1])) {
            $nextEvent = Event::findOne($eventIds[$eventKey + 1]);
        }

        return $this->render('event', [
            'event' => $event,
            'nextEvent' => $nextEvent,
            'prevEvent' => $prevEvent,
        ]);
    }

    /*public function actionTest($alias) {
        $event = $this->findEvent($alias);
        $nextEvent = null;
        $prevEvent = null;

        $date = new \DateTime;
        $date->setTimestamp($event->date);
        $date2 = clone $date;
        $firstDay = $date->modify('first day of last month')->format('U');
        $lastDay = $date2->modify('last day of next month')->format('U');

        $query = Event::find()
            //->select(['id', 'date'])
            ->where(['between', 'date', $firstDay, $lastDay])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->andWhere(['show_on_main' => 1])
            ->orderBy('value_index DESC, date ASC')
            ->asArray();

        $eventsArr = [];

        foreach ($query->all() as $e) {
            $eventsArr[date('n', $e['date'])][] = $e;
        }

        ksort($eventsArr);
        $eventIds = [];
        echo '<table>';
        echo '<tr>
        <td>ID</td>
        <td>Дата</td>
        <td>Индекс</td>
        <td>Алиас</td>
        <td>Заголовок</td>
        </tr>';
        foreach ($eventsArr as $m => $eIds) {
            foreach ($eIds as $eId) {
                echo '<tr>';
                $eventIds[] = $eId['id'];
                echo '<td>'.$eId['id'].'</td>'.
                    '<td>'.date('d.m.y', $eId['date']).'</td>'.
                    '<td>'.$eId['value_index'].'</td>'.
                    '<td>'.$eId['alias'].'</td>'.
                    '<td>'.$eId['title'].'</td>';
                echo '</tr>';
            }
        }
        echo '</table>';


        $eventKey = array_search($event->id, $eventIds);
        echo 'eventKey: '.$eventKey.'<br>';
        if($eventKey !== null && isset($eventIds[$eventKey - 1])) {
            $prevEvent = Event::findOne($eventIds[$eventKey - 1]);
            echo '<br>';
            echo 'prev: '.$prevEvent->id;
        }
        if($eventKey !== null && isset($eventIds[$eventKey + 1])) {
            $nextEvent = Event::findOne($eventIds[$eventKey + 1]);
            echo '<br>';
            echo 'next: '.$nextEvent->id;
        }
        exit;

        return $this->render('event', [
            'event' => $event,
            'nextEvent' => $nextEvent,
            'prevEvent' => $prevEvent,
        ]);
    }*/

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

    public function actionSitemap() {
        $this->layout = false;
        $dateNow = new \DateTime();
        $year = (int)Yii::$app->settings->get('currentYear', $dateNow->format('Y'));

        $events = Event::find()
            ->where(['between', 'date', \DateTime::createFromFormat('!Y', $year)->format('U'), \DateTime::createFromFormat('!Y', $year + 1)->format('U')])
            ->andWhere(['status' => Event::STATUS_ACTIVE])
            ->andWhere(['show_on_main' => 1])
            ->all();

        return $this->render('sitemap', [
            'events' => $events,
        ]);
    }

    protected function findEvent($alias) {
        $model = Event::find()->where(['alias' => $alias])->one();
        if ($model === null || ($model->status === Event::STATUS_INACTIVE && Yii::$app->user->isGuest)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $model;
    }

    protected function findYear($number = null) {
        if($number) {
            $year = Year::find()->where(['number' => $number])->one();
        } else {
            $year = Year::find()->where(['is_current' => 1])->one();
        }

        if($year === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $year;
    }
}
