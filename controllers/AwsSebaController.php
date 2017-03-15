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
        $tma_vaisala_data_source = \app\models\DataSources::findOne(2);
        $tma_vaisala_data_source_stations = \app\models\DataSourceStations::findAll(['datasourceid' => $tma_vaisala_data_source->id]);
        $count = 0;
        foreach ($tma_vaisala_data_source_stations as $tma_vaisala_data_source_station) {
            $station = \app\models\Station::findOne($tma_vaisala_data_source_station->stationid)->name;
            $path = $tma_vaisala_data_source->datalocation . "\\" . Date('Ymd', time()) . "\\" . $station . '.txt';
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
            $model = new AwsSeba();
            $model->time = str_replace("T001:", "", $array_row[0]) . ' ' . $array_row[1];
            $model->time=Date('Y-m-d H:i:s',  strtotime($model->time));
            $station_name_array = explode("-", $array_row[2]);
            $station_name = $station_name_array[0];
            $model->stationname = $station_name;

            $third_element = explode("=", $array_row[3]);
            if (!empty($third_element[0])) {
                if (strpos($third_element[0], 'CH') !== false) {
                    $model->CH = $third_element[1];
                } else {
                    $model->$third_element[0] = $third_element[1];
                }
            }
            $fourth_element = explode("=", $array_row[4]);
            if (!empty($fourth_element[0])) {
                if (strpos($fourth_element[0], 'CH') !== false) {
                    $model->CH = $fourth_element[1];
                } else {
                    $model->$fourth_element[0] = $fourth_element[1];
                }
            }
            $fifth_element = explode("=", $array_row[5]);
            if (!empty($fifth_element[0])) {
                 if (strpos($fifth_element[0], 'CH') !== false) {
                    $model->CH = $fifth_element[1];
                } else {
                $model->$fifth_element[0] = $fifth_element[1];
                }
            }
            $sixth_element = explode("=", $array_row[6]);
            if (!empty($sixth_element[0])) {
                 if (strpos($sixth_element[0], 'CH') !== false) {
                    $model->CH = $sixth_element[1];
                } else {
                $model->$sixth_element[0] = $sixth_element[1];
                }
            }
            $seventh_element = explode("=", $array_row[7]);
            if (!empty($seventh_element[0])) {
                 if (strpos($seventh_element[0], 'CH') !== false) {
                    $model->CH = $seventh_element[1];
                } else {
                $model->$seventh_element[0] = $seventh_element[1];
                }
            }
            $eigth_element = explode("=", $array_row[8]);
            if (!empty($eigth_element[0])) {
                 if (strpos($eigth_element[0], 'CH') !== false) {
                    $model->CH = $eigth_element[1];
                } else {
                $model->$eigth_element[0] = $eigth_element[1];
                }
            }
            $nineth_element = explode("=", $array_row[9]);
            if (!empty($nineth_element[0])) {
                 if (strpos($nineth_element[0], 'CH') !== false) {
                    $model->CH = $nineth_element[1];
                } else {
                $model->$nineth_element[0] = $nineth_element[1];
                }
            }
            $model->entrydate = Date("Y-m-d H:i:s");
            
            $model->save();
            
//            if ($model->save()) {
//                ///insert data into common table ( weather data)
//                return \app\models\WeatherData::processWeatherData($model, WeatherData::AWS_SEBA, $station->id);
//            }
        }
    }

}
