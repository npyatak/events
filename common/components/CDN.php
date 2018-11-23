<?php

namespace common\components;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Application;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\View;
use yii\helpers\Html;

class CDN extends Component// implements BootstrapInterface
{
    public $enabled = true;

    public $domains = [];
    public $validDomains = [];

    /**
     * @param \yii\base\Application $app
     */
    /*public function bootstrap($app)
    {
        print_r($this->ping('https://webdav.yandex.ru'));exit;
        if(isset(Yii::$app->cdn)) {
            foreach (Yii::$app->cdn->domains as $domain) {
                if($this->ping($domain)) {
                    $this->validDomains[] = $domain;
                }
            }
        }

        print_r($this->validDomains);
        //print_r($this->getUrl('\images\photo2\360810_ins3.png'));
        exit;
    }*/

    public function getUrl($url)
    {
        //print_r($this->domain.$url);exit;
        return $this->domain.$url;
        //return $this->getHost($url);//.'/'.$this->filesystem->getAdapter()->applyPathPrefix($fileName);
    }

    public function getDomain()
    {
        $rand = rand(0, count($this->domains) - 1);

        return $this->domains[$rand];
    }

        /**
     * Получение хоста, на котором лежит файл
     *
     * @param $fileName
     * @return string
     */
    protected function getHost($fileName)
    {
        $domains = $this->domains;

        if (is_string($domains)) {
            $domains = array_map('trim', preg_split('/\s*,\s*/', $domains));
        }

        $index = $this->calculateSum($fileName) % count($domains);
        return $domains[$index];
    }    

    protected function calculateSum($fileName)
    {
        $length = mb_strlen($fileName);
        $length = $length > 100 ? 100 : $length;
        $sum = 0;

        for ($i = 0; $i < $length; $i++) {
            $sum += ord($fileName[$i]);
        }

        return $sum;
    }

    private function checkUrl($url)
    {
        $curl = curl_init($url);
        print_r($url);

        curl_setopt($curl, CURLOPT_NOBODY, true);

        $result = curl_exec($curl);

        $ret = false;

        if ($result !== false) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
            print_r($statusCode);

            if ($statusCode == 200) {
                $ret = true;   
            }
        }
        curl_close($curl);

        return $ret;
    }

    private function ping($host,$port=80,$timeout=6)
    {
        $fsock = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$fsock ) {
                return FALSE;
        } else {
                return TRUE;
        }
    }

    private function isDomainAvailible($domain)
       {
               //check, if a valid url is provided
               if(!filter_var($domain, FILTER_VALIDATE_URL))
               {
                       return false;
               }

               //initialize curl
               $curlInit = curl_init($domain);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //get answer
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
       }
}