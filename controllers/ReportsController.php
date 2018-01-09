<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;

class ReportsController extends \yii\web\Controller {

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

}
