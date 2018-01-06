<?php

namespace app\commands;

use yii\console\Controller;
use app\models\AwsVaisala;
use app\models\AwsVaisalaSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\WeatherData;
use \app\models\DataSourceStations;
use \app\models\DataSources;
use \app\models\Station;

/**
 * AwsVaisalaController implements the CRUD actions for AwsVaisala model.
 */
class VaisalaController extends Controller {

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

    /*
     * Given Vaisala based Data source model the function below
     * process/reads the content of all files locally received from all the stations of a particcular vaisala data source provided
     */

    function processVaisalaStationsDataFilesByDataSourceAndDate($data_source, $datetime) {
        $count = 0;
        if (is_object($data_source)) {
            $data_source_stations = DataSourceStations::findAll(['datasourceid' => $data_source->id]);

            foreach ($data_source_stations as $data_source_station) {
                $station = Station::findOne($data_source_station->stationid);
                ////copy files from remote serrver to local path before processing
                if ($station && $station->status == Station::STATION_STATUS_ACTIVE) {
                    //$path = $data_source->datalocation . "\\" . strtoupper($station->name) . "\\" . Date('Y\\m') . "\\" . $station->name . "__SMSAWS__" . Date('Ymd') . '.txt';
                    $path = \Yii::$app->params['dataFileStorage']['vaisala'] . $data_source->name . '/' . strtoupper($station->name) . "/" . Date('Y/m') . "/" . $station->name . "__SMSAWS__" . Date('Ymd') . '.txt';
                    if (file_exists($path)) {
                        if ($this->ProcessVaisalaFile($path, $station)) {
                            $count++;
                        }
                    }
                }
            }
        }
    }

    /*
     * Given Vaisala Based Data source model the function below
     * downloads all files from remote vaisala data source for all the stations of a particular vaisala data source provided
     */

    function downloadVaisalaStationsFilesByDataSourceAndDate($data_source, $datetime) {
        if (is_object($data_source)) {
            $ftp_server_address = $data_source->ipaddress;
            $ftp_user_name = $data_source->loginname;
            $ftp_user_pass = $data_source->password;
            //$ftp_user_pass = '';
            $data_source_stations = DataSourceStations::findAll(['datasourceid' => $data_source->id]);
            foreach ($data_source_stations as $data_source_station) {
                $station = Station::findOne($data_source_station->stationid);
                if ($station && $station->status == Station::STATION_STATUS_ACTIVE) {
//                    $remote_file_path = $data_source->datalocation . "/" . $station->name . "/" . Date('Y/m/', strtotime($datetime));
//                    $local_file_path = \Yii::$app->params['dataFileStorage']['vaisala'] . $data_source->name . '/' . $station->name . "/" . Date('Y/m/', strtotime($datetime));
                    $remote_file_path = $station->name . "/" . Date('Y/m/');
                    $local_file_path = \Yii::$app->params['dataFileStorage']['vaisala'] . $data_source->name . '/' . $station->name . "/" . Date('Y/m/');
                    ////creating a new folder to receive data files for a particular day
//                    Yii::trace('Creating a directory ' . $local_file_path . ' into the local server to keep the received files from ' . $ftp_server_address . ' ....', __METHOD__);
                    ///check if local folder/diretory exists
                    //Check if the directory already exists.
                    try {
                        if (!is_dir($local_file_path)) {
                            //Directory does not exist, so lets create it.
                            mkdir($local_file_path, 0777, TRUE);
                        } else {
                            chmod($local_file_path, 0777);
                        }
                        //
                        $datasource_files_processed = $this->downloadRemoteVaisalaFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path);
                        if (count($datasource_files_processed)) {
                            $coppied_remotefiles[$data_source->id] = $datasource_files_processed;
                        }
                    } catch (Exception $exc) {
//                        Yii::trace($exc->getTraceAsString(), __METHOD__);
                    }
                }
            }
        }
    }

    public function actionImport() {
        //getting all AWS(file based) data sources
        $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_VAISALA])->all();
        ///copying files from remote data source servers to local servers
        if ($data_sources) {
            foreach ($data_sources as $data_source) {
                //getting all stations under each AWS(file based) data sources
                ////getting/downloading vaisala data source data station by station
                $this->downloadVaisalaStationsFilesByDataSourceAndDate($data_source, time());
            }
        }

        ////processing data files already in local machine
        // $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_VAISALA])->all();
        if ($data_sources) {
            foreach ($data_sources as $data_source) {
                //getting all stations under each AWS(file based) data sources
                $this->processVaisalaStationsDataFilesByDataSourceAndDate($data_source, time());
            }
        }
        echo 'Done...';
//        return $this->redirect(['index']);
    }

    function downloadRemoteVaisalaFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path) {
        $local_files_processed = array();
////copying file from windows server via ftp
// set up basic ssl connection
//        Yii::trace('Try connecting to the ftp server ' . $ftp_server_address . ' ....', __METHOD__);
        $conn_id = ftp_connect($ftp_server_address);
        ftp_set_option($conn_id, FTP_TIMEOUT_SEC, 180);
// echo $remote_file;
        if ($conn_id) {

// login with username and password
//            Yii::trace('try login to the remote ftp server' . $ftp_server_address . ' ....', __METHOD__);
            if (ftp_login($conn_id, $ftp_user_name, $ftp_user_pass)) {
//listing files from the firectory
//                echo $remote_file_path;
//                exit;
                $contents = ftp_nlist($conn_id, $remote_file_path);
//processing remote files
                \Yii::beginProfile('Checking and loooping files to download ...');
                if ($contents) {
                    foreach ($contents as $key => $filename) {
                        $file = explode('.', $filename);
//chcking if the file is the text file and has been created on the day when the script is running
                        if ('txt' == $file[(count($file) - 1)] && strpos($filename, date('Ymd', time())) !== false) {
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
                    //   Yii::trace("Can not open the directory " . $remote_file_path . " specified ....");
                }
                \Yii::endProfile('end looping files to download');
            } else {

                //echo "Login to " . $ftp_server_address . " using provided credetials failed";
//                Yii::trace("Login to " . $ftp_server_address . " using provided credetials failed ....", __METHOD__);
            }
// close the connection
            ftp_close($conn_id);
        } else {
            // echo "Connection to address " . $ftp_server_address . " failed Please check your settings";
//            Yii::trace("Connection to address " . $ftp_server_address . " failed Please check your settings ....", __METHOD__);
        }
        return $local_files_processed;
    }

    public function ProcessVaisalaFile($path, $station) {
        $rows = file($path);
        if (is_array($rows)) {
            foreach ($rows as $row) {
                $array_row = preg_split("/[\s,]+/", $row);
                //removing "/" when element is blank for each row to be processed   

                foreach ($array_row as $key => $value) {
                    if ($key > 1 && $array_row[$key] == '/') {
                        $array_row[$key] = NULL;
                    }
                }
                //end removing "/" when element is blank

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
                    $model->StationName = $station->name;
                    $model->VaisalaVersion = 'V 2.0';
                    $model->EntryDate = Date("Y/m/d h:i:sa");
                    $model->validate();
                    if ($model->save()) {
                        //insert data into common table ( weather data)
                        WeatherData::processWeatherData($model, WeatherData::AWS_VAISALA, $station->id);
                    }
                }
            }
        }
    }

}
