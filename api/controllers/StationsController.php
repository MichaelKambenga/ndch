<?php

//namespace app\api\controllers;

namespace app\controllers;

use yii\filters\auth\HttpBasicAuth;

//use yii\filters\auth\QueryParamAuth;

/*
  use yii\rest\ActiveController;

  class StationsController extends ActiveController
  {
  public $modelClass = '\app\models\Station';
  }
 */

class StationsController extends \yii\web\Controller {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                /** @var User $user */
                $user = \app\models\User::findByUsername($username);
                if ($user && $user->validatePassword($password)) {
                    return $user;
                }
            }
        ];

        return $behaviors;
    }

    public function actionIndex() {
//      http://localhost:8080/ndch/api/stations
//      http://localhost:8080/ndch/api/stations/7
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $attributes = \yii::$app->request->get();
        if ($attributes) {
            $stations = \app\models\Station::find()->where(['id' => $attributes['id']])->one();
        } else {
            $stations = \app\models\Station::find()->all();
        }
        if (count($stations) > 0) {
            return ['status' => true, 'data' => $stations];
        } else {
            return ['status' => false, 'data' => 'No station found.'];
        }
    }

    public function actionSearchStation() {
//      http://localhost:8080/ndch/api/stations/search-station
//      http://localhost:8080/ndch/api/stations/search-station?name=JNIA     
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \app\models\Station();
        $attributes = \yii::$app->request->get();
        if ($attributes) {
            foreach ($attributes as $key => $value) {
                if (!$model->hasAttribute($key)) {
                    throw new \yii\web\HttpException(404, 'Invalid attribute: ' . $key);
                } else {
                    $stations = \app\models\Station::find()->where([$key => $value])->one();
                }
            }
        } else {
            $stations = \app\models\Station::find()->all();
        }
        if (count($stations) > 0) {
            return ['status' => true, 'data' => $stations];
        } else {
            return ['status' => false, 'data' => 'No station found.'];
        }
    }

    public function actionStationsValues() {
        // http://localhost:8080/ndch/api/stations/stations-values?from='2014-07-19 00:00:00'
        //  http://localhost:8080/ndch/api/stations/stations-values?param='PA'&from='2014-07-19 00:00:00'

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \app\models\Station();
        $attributes = \yii::$app->request->get();
        if (array_key_exists("param", $attributes)) {
            /*
             *  PA => Instant Atmospheric pressure
             *  DP => Instant Dew point
             *  PR => Precipitation
             *  RH => Instant Relative Humidity
             *  SR => Instant Solar Radiation
             *  TA => Instant Temperature
             *  WD => Instant Wind Direction
             *  WS => Instant Wind Speed 
             */
            $parameter = $attributes['param'];
        }
        if (array_key_exists("from", $attributes)) {
            $timestamp = $attributes['from'];
            if ($parameter) {
                $parameter = str_replace("'", '"', $parameter);
                $values = \app\models\WeatherData::find()->select(['stationid', 'StationName', 'TIME', $parameter])->where(['>=', 'TIME', $timestamp])->all();
            } else {
                $values = \app\models\WeatherData::find()->where(['>=', 'TIME', $timestamp])->all();
            }
            if (count($values) > 0) {
                return ['status' => true, 'data' => $values];
            } else {
                return ['status' => false, 'data' => 'No record found.'];
            }
        } else {
            return ['status' => false, 'data' => 'Invalid Parameters Supplied.'];
        }
    }

    public function actionValue() {
        // http://localhost:8080/ndch/api/stations/value/1?from='2014-07-19 00:00:00'
        // http://localhost:8080/ndch/api/stations/value/1?param='PA'&from='2014-07-19 00:00:00'

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \app\models\Station();
        $attributes = \yii::$app->request->get();
        if (array_key_exists("param", $attributes)) {
            /*
             *  PA => Instant Atmospheric pressure
             *  DP => Instant Dew point
             *  PR => Precipitation
             *  RH => Instant Relative Humidity
             *  SR => Instant Solar Radiation
             *  TA => Instant Temperature
             *  WD => Instant Wind Direction
             *  WS => Instant Wind Speed 
             */
            $parameter = $attributes['param'];
        }
        if (array_key_exists("from", $attributes)) {
            $timestamp = $attributes['from'];
            if ($parameter) {
                $parameter = str_replace("'", '"', $parameter);
                $values = \app\models\WeatherData::find()->select(['stationid', 'StationName', 'TIME', $parameter])->where(['stationid' => $attributes['id']])->andWhere(['>=', 'TIME', $timestamp])->all();
            } else {
                $values = \app\models\WeatherData::find()->where(['stationid' => $attributes['id']])->andWhere(['>=', 'TIME', $timestamp])->all();
            }
            if (count($values) > 0) {
                return ['status' => true, 'data' => $values];
            } else {
                return ['status' => false, 'data' => 'No record found.'];
            }
        } else {
            return ['status' => false, 'data' => 'Invalid Parameters Supplied.'];
        }
    }

}
