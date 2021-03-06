<?php

namespace app\controllers;

use Yii;
use app\models\AwsSeba;
use app\models\AwsSebaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\WeatherData;

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
        //getting all AWS(file based) data sources
        $data_sources = \app\models\DataSources::find()->where(['datasourcetype' => \app\models\DataSources::DATA_SOURCE_FAILEBASED])->all();
        foreach ($data_sources as $data_source) {

            //getting all stations under each AWS(file based) data sources
            $data_source_stations = \app\models\DataSourceStations::findAll(['datasourceid' => $data_source->id]);
            $count = 0;
            foreach ($data_source_stations as $data_source_station) {                
                $station = \app\models\Station::findOne($data_source_station->stationid);
                $_directory_path = $data_source->datalocation . Date('Ymd', time());
                //$path = $tma_vaisala_data_source->datalocation . Date('Ymd', time()) . "\\" . $station->name . '.txt';
                $available_station_data = array(); //keeps the available files from server
                if ($handle = opendir($_directory_path)) {
                    /* This is the correct way to loop over the directory. */
                    while (false !== ($entry = readdir($handle))) {
                        if (strpos($entry, $station->name) !== false) {
                            ///setting file location based on the availble data files for a particular station
                            $path = $_directory_path . '\\' . $entry;
                            //array_push($available_station_data, $path);
                            if ($this->ProcessSebaFile($path, $station)) {
                                $count++;
                            }
                        }
                    }
                    closedir($handle);
                }
            }
        }
        return $this->redirect(['index']);
    }

    public function ProcessSebaFile($path, $station) {
        $rows = file($path);
        foreach ($rows as $row) {
            $array_row = preg_split("/[\s,]+/", $row);
            $elements = count($array_row);
            //removing line terminator(;) in last item from the row
            if ($array_row[$elements - 2]) {
                $itemlegth = strlen($array_row[$elements - 2]);
                $array_row[$elements - 2] = substr($array_row[$elements - 2], 0, $itemlegth - 1);
            }
            //end removing line terminator(;) in last item from the row

            $model = new AwsSeba();
            $model->TIME = str_replace("T001:", "", $array_row[0]) . ' ' . $array_row[1];
            $model->TIME = Date('Y-m-d H:i:s', strtotime($model->TIME));
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
            $model->EntryDate = Date("Y-m-d H:i:s");

            if ($model->save()) {
                ///insert data into common table ( weather data)
                WeatherData::processWeatherData($model, WeatherData::AWS_SEBA, $station->id);
            }
        }
    }

public function actionCopyDataFile(){
$source = '192.168.43.36/DEMASole/Spool/success';
$dest = '/home/charles/Desktop/04022017 Issues.txt';

$response = copy($source, $dest);

echo $response;
die();
}

}
