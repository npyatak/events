<?php

namespace common\components;

use yii\base\Component;
use yii\caching\Cache;
use Yii;

class Settings extends Component {
    /**
     * @var string settings model. Make sure your settings model calls clearCache in the afterSave callback
     */
    public $modelClass = 'common\models\Settings';

    protected $model;

    public $cache;

    /**
     * To be used by the cache component.
     *
     * @var string cache key
     */
    public $cacheKey = 'settings';

    /**
     * Holds a cached copy of the data for the current request
     *
     * @var mixed
     */
    private $_data = null;

    /**
     * Initialize the component
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function init() {
        parent::init();

        $this->model = new $this->modelClass;
    }

    public function get($key, $default=null) {
        $data = $this->getRawConfig();
        return isset($data[$key]) ? $data[$key] : $default;
    }

    public function has($key) {
        $setting = $this->get($key);
        return is_null($setting) ? false : true;
    }

    public function set($key, $value) {
        $this->clearCache();
        if ($this->model->setSetting($key, $value)) {
            return true;
        }
        return false;
    }

    /**
     * Clears the settings cache on demand.
     * If you haven't configured cache this does nothing.
     *
     * @return boolean True if the cache key was deleted and false otherwise
     */
    public function clearCache() {
        $this->_data = null;
        Yii::$app->cacheFrontend->delete($this->cacheKey);
        Yii::$app->cacheBackend->delete($this->cacheKey);
    }

    /**
     * Returns the raw configuration array
     *
     * @return array
     */
    public function getRawConfig() {
        if ($this->_data === null) {
            $data = Yii::$app->cacheFrontend->get($this->cacheKey);
            
            if ($data === false) {
                $data = $this->model->getSettings();
                Yii::$app->cacheFrontend->set($this->cacheKey, $data);
            }
            $this->_data = $data;
        }
        return $this->_data;
    }
}
