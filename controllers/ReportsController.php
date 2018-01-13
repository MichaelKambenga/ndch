<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

class ReportsController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
               // 'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['reg-stations','stations-daily-observations','stations-observations','stations-latest-observations','min-max-observations'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                  //  'reg-stations' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
           
        ];
    }

    public function actionRegStations() {
        $model = new \app\models\ReportFilterForm();
        $dataProvider = NULL;

        if ($model->load(Yii::$app->request->get())) {
            $dataProvider = $model->getStations();
        }
        return $this->render('RegStations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStationsDailyObservations() {
        $model = new \app\models\ReportFilterForm();
        $dataProvider = NULL;
        $model->scenario = 'daily';
        if ($model->load(Yii::$app->request->get())) {
            if (isset($model->date_end)) {
                $model->date_end = Date('Y-m-d 23:59:59', strtotime($model->date_end));
            }
            if (isset($model->date_start)) {
                $model->date_start = Date('Y-m-d 00:00:00', strtotime($model->date_start));
            }
            $dataProvider = $model->getStationsDailyObservations();
        }
        return $this->render('DailyStationObservations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStationsObservations() {
        $model = new \app\models\ReportFilterForm();
        $dataProvider = NULL;
        $model->scenario = 'observation';
        if ($model->load(Yii::$app->request->get())) {
            if (isset($model->date_end)) {
                $model->date_end = Date('Y-m-d 23:59:59', strtotime($model->date_end));
            }
            if (isset($model->date_start)) {
                $model->date_start = Date('Y-m-d 00:00:00', strtotime($model->date_start));
            }
            $dataProvider = $model->getStationsObservations();
        }
        return $this->render('StationsObservations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStationsLatestObservations() {
        $model = new \app\models\ReportFilterForm();
        $dataProvider = NULL;
        // $model->scenario = 'observation';
        if ($model->load(Yii::$app->request->get())) {
            if ($model->weather_element) {
                
            }
            $dataProvider = $model->getStationsLatestObservationsTimes();
        }
        return $this->render('StationsLatestObservations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMinMaxObservations() {
         $model = new \app\models\ReportFilterForm();
        $dataProvider = NULL;
        $model->scenario = 'min-max-observations';
        if ($model->load(Yii::$app->request->get())) {
            if (isset($model->date_end)) {
                $model->date_end = Date('Y-m-d 23:59:59', strtotime($model->date_end));
            }
            if (isset($model->date_start)) {
                $model->date_start = Date('Y-m-d 00:00:00', strtotime($model->date_start));
            }
            $dataProvider = $model->getMinMaxObservationsTimes();
        }
        return $this->render('MinMaxStationObservations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

}
