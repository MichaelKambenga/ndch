<?php

namespace app\controllers;

use Yii;
use app\models\AwsVaisala;
use app\models\AwsVaisalaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwsVaisalaController implements the CRUD actions for AwsVaisala model.
 */
class AwsVaisalaController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AwsVaisala models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AwsVaisalaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwsVaisala model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwsVaisala model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AwsVaisala();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AwsVaisala model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AwsVaisala model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AwsVaisala model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwsVaisala the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwsVaisala::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport() {
        $tma_vaisala_data_source = \app\models\DataSources::findOne(1);
        $tma_vaisala_data_source_stations = \app\models\DataSourceStations::findAll(['datasourceid' => $tma_vaisala_data_source->id]);
        $count = 0;
        foreach ($tma_vaisala_data_source_stations as $tma_vaisala_data_source_station) {
            $station = \app\models\Station::findOne($tma_vaisala_data_source_station->stationid)->name;
            $path = $tma_vaisala_data_source->datalocation . "\\" . $station . "\\" . Date('Y', time()) . "\\" . Date('m', time()) . "\\" . $station . "_SMSAWS_" . Date('Ymd', time()) . '.txt';
            if ($this->ProcessVaisalaFile($path,$station)) {
                $count++;
            }
        }
        if ($count) {
            $message = "Successflly imported with data processed";
        } else {
            $message = "Successflly imported with no data processed";
        }
        return $this->redirect(['index']);
    }

    public function ProcessVaisalaFile($path,$station) {
        $rows = file($path);
        foreach ($rows as $row) {
            $array_row = preg_split("/[\s,]+/", $row);
            if ($array_row[0] != 'TIME') {
                $model = new AwsVaisala();
                $model->TIME = $array_row[0] . ' ' . $array_row[1];
                $model->BAT = $array_row[2];
                $model->DP = $array_row[3];
                $model->DP1HA = $array_row[4];
                $model->DP1HX = $array_row[5];
                $model->DP1HM = $array_row[6];
                $model->PA = $array_row[7];
                $model->PA1HA = $array_row[8];
                $model->PA1HX = $array_row[9];
                $model->PA1HM = $array_row[10];
                $model->PR = $array_row[11];
                $model->PR1HS = $array_row[12];
                $model->PR24HS = $array_row[13];
                $model->PR5MS00 = $array_row[14];
                $model->PR5MS05 = $array_row[15];
                $model->PR5MS10 = $array_row[16];
                $model->PR5MS15 = $array_row[17];
                $model->PR5MS20 = $array_row[18];
                $model->PR5MS25 = $array_row[19];
                $model->PR5MS30 = $array_row[20];
                $model->PR5MS35 = $array_row[21];
                $model->PR5MS40 = $array_row[22];
                $model->PR5MS45 = $array_row[23];
                $model->PR5MS50 = $array_row[24];
                $model->PR5MS55 = $array_row[25];
                $model->RH = $array_row[26];
                $model->RH1HA = $array_row[27];
                $model->RH1HX = $array_row[28];
                $model->RH1HM = $array_row[29];
                $model->SR = $array_row[30];
                $model->SR1HA = $array_row[31];
                $model->SR1HX = $array_row[32];
                $model->SR1HM = $array_row[33];
                $model->TA = $array_row[34];
                $model->TA1HA = $array_row[35];
                $model->TA1HX = $array_row[36];
                $model->TA1HM = $array_row[37];
                $model->WD = $array_row[38];
                $model->WD2MA = $array_row[39];
                $model->WD10MA = $array_row[40];
                $model->WD2MX = $array_row[41];
                $model->WD10MX = $array_row[42];
                $model->WD2MM = $array_row[43];
                $model->WD10MM = $array_row[44];
                $model->WD1HA = $array_row[45];
                $model->WD1HX = $array_row[46];
                $model->WD1HM = $array_row[47];
                $model->WS = $array_row[48];
                $model->WS2MA = $array_row[49];
                $model->WS10MA = $array_row[50];
                $model->WS2MX = $array_row[51];
                $model->WS10MX = $array_row[52];
                $model->WS2MM = $array_row[53];
                $model->WS10MM = $array_row[54];
                $model->QFE = $array_row[55];
                $model->QFE1HA = $array_row[56];
                $model->QFE1HX = $array_row[57];
                $model->QFE1HM = $array_row[58];
                $model->QFF = $array_row[59];
                $model->QFF1HA = $array_row[60];
                $model->QFF1HX = $array_row[61];
                $model->QFF1HM = $array_row[62];
                $model->QNH = $array_row[63];
                $model->QNH1HA = $array_row[64];
                $model->QNH1HX = $array_row[65];
                $model->QNH1HM = $array_row[66];
                $model->a = $array_row[67];
                $model->p = $array_row[68];
                $model->ETO = $array_row[69];
                $model->Path = $path;
                $model->StationName = $station;
                $model->VaisalaVersion = 'V 2.0';
                $model->EntryDate = Date("Y/m/d h:i:sa");
                return $model->save();
            }
        }
    }

}
