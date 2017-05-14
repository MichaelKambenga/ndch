<?php

namespace app\controllers;

use Yii;
use app\models\AwsSeba;
use app\models\AwsSebaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\WeatherData;
use \app\models\DataSourceStations;
use \app\models\DataSources;
use \app\models\Station;

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

    /*
     * Given SEBA based Data source model the function below
     * process/reads the content of all files locally received from all the stations of a particcular SEBA data source provided
     */

    function processSEBAStationsDataFilesByDataSourceAndDate($data_source, $datetime) {
        $count = 0;
        if (is_object($data_source)) {
            $data_source_stations = DataSourceStations::findAll(['datasourceid' => $data_source->id]);
            foreach ($data_source_stations as $data_source_station) {
                $station = Station::findOne($data_source_station->stationid);
                if ($station && $station->status == Station::STATION_STATUS_ACTIVE) {
                    ///$_directory_path = $data_source->datalocation . Date('Ymd', time());
                    $directory_path = \Yii::$app->params['dataFileStorage']['seba'] . $data_source->name . '/' . date('Ymd', strtotime($datetime));
                    $handle = opendir($directory_path);
                    if ($handle) {
                        /* This is the correct way to loop over the directory. */
                        while (false !== ($entry = readdir($handle))) {
                            if (strpos($entry, $station->name) !== false) {
                                ///setting file location based on the availble data files for a particular station
                                $path = $directory_path . '/' . $entry;
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
        }
    }

    /*
     * Given  SEBA based Data source Model the function below
     * downloads all files from remote SEBA data source for all the stations of a particular SEBA data source provided
     */

    function downloadSEBAStationsFilesByDataSourceAndDate($data_source, $datetime) {
        if (is_object($data_source)) {
            $ftp_server_address = $data_source->ipaddress;
            $ftp_user_name = $data_source->loginname;
            $ftp_user_pass = $data_source->password;
            //$ftp_user_pass = '';
            $remote_file_creation_date = date('Ymd', strtotime($datetime));
            $remote_file_path = $data_source->datalocation . '/' . $remote_file_creation_date;
            $local_file_path = \Yii::$app->params['dataFileStorage']['seba'] . $data_source->name . '/' . $remote_file_creation_date . '/';
            ////creating a new folder to receive data files for a particular day
            Yii::trace('Creating a directory ' . $remote_file_creation_date . ' into the local server to keep the received files from ' . $ftp_server_address . ' ....', __METHOD__);
            if (mkdir($local_file_path, 0777, TRUE)) {
                $datasource_files_processed = $this->downloadRemoteFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path, $remote_file_creation_date);
                if (count($datasource_files_processed)) {
                    $coppied_remotefiles[$data_source->id] = $datasource_files_processed;
                }
            } else {
                Yii::trace('Failed to Create a directory into the local server...', __METHOD__);
            }
        }
    }

    /*
     * this function download a file from a remote server to local derectory
     */

    public function actionImport() {
        $coppied_remotefiles = array();  //stores all the copied remot file
        //getting all SEBA AWS(file based) data sources
        $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_SEBA])->all();
        ///copying or downloading  all files from remote SEBA data source to local server
        if ($data_sources) {
            foreach ($data_sources as $data_source) {
                ///download all the data files from a remote SEBA BAsed data source
                $this->downloadSEBAStationsFilesByDataSourceAndDate($data_source, time());
            }
        }
        //PROCESSING DATA FILE ALREADY IN LOCAL MACHINE
        foreach ($data_sources as $data_source) {
            //getting all stations under each AWS(file based) data sources
            $this->processSEBAStationsDataFilesByDataSourceAndDate($data_source, time());
        }

        ////reading each file from coppied into local directory
        return $this->redirect(array('index'));
    }

////download a remote file created in a given date to a local server in a specified location
//returns an array with local files processed successful
    function downloadRemoteFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path, $remote_file_creation_date) {
        $local_files_processed = array();
////copying file from windows server via ftp
// set up basic ssl connection
        Yii::trace('Try connecting to the ftp server ' . $ftp_server_address . ' ....', __METHOD__);
        $conn_id = ftp_connect($ftp_server_address);

// echo $remote_file;
        if ($conn_id) {

// login with username and password
            Yii::trace('try login to the remote ftp server' . $ftp_server_address . ' ....', __METHOD__);
            if (ftp_login($conn_id, $ftp_user_name, $ftp_user_pass)) {
//listing files from the firectory
//                echo $remote_file_path;
//                exit;
                $contents = ftp_nlist($conn_id, $remote_file_path);

//processing remote files
//  var_dump($contents);
                \Yii::beginProfile('Checking and loooping files to download ...');
                if ($contents) {
                    foreach ($contents as $key => $filename) {
                        $file = explode('.', $filename);
//chcking if the file is the text file and has been created on the day when the script is running
                        //  if ('txt' == $file[(count($file) - 1)] && (preg_match('(' . $remote_file_creation_date . ')', $filename) === 1)) {
                        if ('txt' == $file[(count($file) - 1)]) {
                            //copying the file
                            $remote_file = $filename;
                            $local_file = explode('/', $filename);
                            $local_file_name = $local_file[count($local_file) - 1];
                            $local_file = $local_file_path . $local_file_name;
                            \Yii::beginProfile('copying file to local diretory');
// try to download $server_file and save to $local_file
                            if (ftp_get($conn_id, $local_file, $remote_file, FTP_BINARY)) {
                                array_push($local_files_processed, $local_file); // adding successfule processed files into the return array
                                \Yii::beginProfile("copying file Successfully written to $local_file\n");
//echo "Successfully written to $local_file_path\n";
                            } else {
                                \Yii::beginProfile("copying file to $local_file failed\n");
//echo "There was a problem\n";
                            }
// some code to be profiled
// some other code to be profiled
                            \Yii::endProfile('end copying file to local diretory');
                        }
                    }
                } {
                    // echo "Can not open the directory specified ....";
                    Yii::trace("Can not open the directory " . $remote_file_path . " specified ....");
                }
                \Yii::endProfile('end looping files to download');
            } else {

                //echo "Login to " . $ftp_server_address . " using provided credetials failed";
                Yii::trace("Login to " . $ftp_server_address . " using provided credetials failed ....", __METHOD__);
            }
// close the connection
            ftp_close($conn_id);
        } else {
            // echo "Connection to address " . $ftp_server_address . " failed Please check your settings";
            Yii::trace("Connection to address " . $ftp_server_address . " failed Please check your settings ....", __METHOD__);
        }
        return $local_files_processed;
    }

    public function ProcessSebaFile($path, $station) {
        $rows = file($path);
//        var_dump($rows);
//        exit;
        if (is_array($rows)) {
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
                if (isset($array_row[3])) {
                    $third_element = explode("=", $array_row[3]);
                    if (!empty($third_element[0])) {
                        if (strpos($third_element[0], 'CH') !== false) {
                            $model->CH = $third_element[1];
                        } else {
                            $model->$third_element[0] = $third_element[1];
                        }
                    }
                }

                if (isset($array_row[4])) {
                    $fourth_element = explode("=", $array_row[4]);
                    if (!empty($fourth_element[0])) {
                        if (strpos($fourth_element[0], 'CH') !== false) {
                            $model->CH = $fourth_element[1];
                        } else {
                            $model->$fourth_element[0] = $fourth_element[1];
                        }
                    }
                }

                if (isset($array_row[5])) {
                    $fifth_element = explode("=", $array_row[5]);

                    if (!empty($fifth_element[0])) {

                        if (strpos($fifth_element[0], 'CH') !== false) {
                            $model->CH = $fifth_element[1];
                        } else {
                            $model->$fifth_element[0] = $fifth_element[1];
                        }
                    }
                }

                if (isset($array_row[6])) {
                    $sixth_element = explode("=", $array_row[6]);
                    if (!empty($sixth_element[0])) {
                        if (strpos($sixth_element[0], 'CH') !== false) {
                            $model->CH = $sixth_element[1];
                        } else {
                            $model->$sixth_element[0] = $sixth_element[1];
                        }
                    }
                }

                if (isset($array_row[7])) {
                    $seventh_element = explode("=", $array_row[7]);
                    if (!empty($seventh_element[0])) {
                        if (strpos($seventh_element[0], 'CH') !== false) {
                            $model->CH = $seventh_element[1];
                        } else {
                            $model->$seventh_element[0] = $seventh_element[1];
                        }
                    }
                }
                if (isset($array_row[8])) {
                    $eigth_element = explode("=", $array_row[8]);
                    if (!empty($eigth_element[0])) {
                        if (strpos($eigth_element[0], 'CH') !== false) {
                            $model->CH = $eigth_element[1];
                        } else {
                            $model->$eigth_element[0] = $eigth_element[1];
                        }
                    }
                }
                if (isset($array_row[9])) {
                    $nineth_element = explode("=", $array_row[9]);
                    if (!empty($nineth_element[0])) {
                        if (strpos($nineth_element[0], 'CH') !== false) {
                            $model->CH = $nineth_element[1];
                        } else {
                            $model->$nineth_element[0] = $nineth_element[1];
                        }
                    }
                }
                $model->EntryDate = Date("Y-m-d H:i:s");

                if ($model->save()) {

                    ///insert data into common table ( weather data)
                    if (is_object($station)) {
                        WeatherData::processWeatherData($model, WeatherData::AWS_SEBA, $station->id);
                    }
                }
            }
        }
    }

}
