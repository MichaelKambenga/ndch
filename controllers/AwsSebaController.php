<?php

namespace app\controllers;

use Yii;
use app\models\AwsSeba;
use app\models\AwsSebaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AwsSebaController implements the CRUD actions for AwsSeba model.
 */
class AwsSebaController extends Controller {

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
     * Lists all AwsSeba models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AwsSebaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AwsSeba model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AwsSeba model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AwsSeba();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AwsSeba model.
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
     * Deletes an existing AwsSeba model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AwsSeba model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AwsSeba the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AwsSeba::findOne($id)) !== null) {
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
            if ($this->ProcessSebaFile($path, $station)) {
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

    public function ProcessSebaFile($path, $station) {
        $rows = file($path);
        foreach ($rows as $row) {
            $array_row = preg_split("/[\s,]+/", $row);
            if ($array_row[0] != 'TIME') {
                $model = new AwsVaisala();
                $model->time = $array_row[0] . ' ' . $array_row[1];
                $model->D = $array_row[2];
                $model->U = $array_row[3];
                $model->PL = $array_row[4];
                $model->TL = $array_row[5];
                $model->G = $array_row[6];
                $model->CH = $array_row[7];
//                $model->Path = $path;
                $model->stationname = $station;
                $model->entrydate = Date("Y/m/d h:i:sa");
                return $model->save();
            }
        }
    }

}
