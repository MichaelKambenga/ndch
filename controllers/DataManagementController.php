<?php

namespace app\controllers;

use Yii;
use app\models\DataManagement;
use app\models\WeatherDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\DataSources;
use app\models\DataSourceStations;
use app\models\Station;

/**
 * WeatherDataController implements the CRUD actions for WeatherData model.
 */
class DataManagementController extends \app\components\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'import-aws-data' => ['POST'],
                ],
            ],
        ];
    }

    public function actionImportAwsData() {
        $model = new DataManagement();
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('DataManagement');
            $model->scenario = 'import-aws-data';
//            $model->StationId = $post['StationId'];
            $model->DateStart = $post['DateStart'];
            $model->DateEnd = $post['DateEnd'];
            $model->AWSType = $post['AWSType'];
            $model->DateStart = date('Y-m-d', strtotime($model->DateStart));
            $model->DateEnd = date('Y-m-d', strtotime($model->DateEnd));

            if ($model->validate()) {
                ///process data import here
                $records = 0;
                $days_updated = '';
                $time = strtotime($model->DateStart);
                switch ($model->AWSType) {
                    case \app\models\WeatherData::AWS_SEBA:
                        $coppied_remotefiles = array();  //stores all the copied remot file
                        //getting all SEBA AWS(file based) data sources
                        $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_SEBA])->all();
                        ////looping wothin the dates
                        while (date('Y-m-d', $time) <= $model->DateEnd) {

                            ///copying or downloading  all files from remote SEBA data source to local server
                            if ($data_sources) {
                                foreach ($data_sources as $data_source) {
                                    ///download all the data files from a remote SEBA BAsed data source
                                    $this->downloadSEBAStationsFilesByDataSourceAndDate($data_source, $time);
                                }
                            }
                            //PROCESSING DATA FILE ALREADY IN LOCAL MACHINE
                            foreach ($data_sources as $data_source) {
                                //getting all stations under each AWS(file based) data sources
                                $this->processSEBAStationsDataFilesByDataSourceAndDate($data_source, $time);
                            }
                            $days_updated .= ', ' . date("d-M-Y", $time);
                            $time = $time + 86400;
                            // echo $model->DateStart;
//                            exit;
                            $records++;
                        }
                        //looping through all the dates in between the date start and date end
                        break;

                    case \app\models\WeatherData::AWS_VAISALA:
//                       
                        //getting all AWS(file based) data sources
                        $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_VAISALA])->all();
                        ///copying files from remote data source servers to local servers
                        if ($data_sources) {
//                            echo date('Y-m-d', $time).'='.$model->DateEnd;
//                            exit;
                            while (date('Y-m-d', $time) <= $model->DateEnd) {
                                foreach ($data_sources as $data_source) {
                                    //getting all stations under each AWS(file based) data sources
                                    ////getting/downloading vaisala data source data station by station

                                    $this->downloadVaisalaStationsFilesByDataSourceAndDate($data_source, $time);
                                }//                        }
                                ////processing data files already in local machine
                                // $data_sources = DataSources::find()->where(['datasourcetype' => DataSources::DATA_SOURCE_FAILEBASED, 'awsvendor' => DataSources::DATA_SOURCE_AWS_VAISALA])->all();
//                        if ($data_sources) {
                                foreach ($data_sources as $data_source) {
                                    //getting all stations under each AWS(file based) data sources
                                    $this->processVaisalaStationsDataFilesByDataSourceAndDate($data_source, $time);
                                }
                                $days_updated .= ', ' . date("d-M-Y", $time);
                                $time = $time + 86400;
                            }
                        }

                        break;
                }
                if ($records) {
                    $model->DateEnd = $model->DateStart = $model->StationId = $model->AWSType = NULL;
                    Yii::$app->session->setFlash('sms', 'A Total of ' . $records . ' Days has been processed in which the following days has been updated ' . substr($days_updated, 1));
                } else {
                    Yii::$app->session->setFlash('sms', 'No records has been found or processed');
                }
                //return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('import_aws_data', [
                    'model' => $model,
        ]);
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
                    $directory_path = \Yii::$app->params['dataFileStorage']['seba'] . $data_source->name . '/' . date('Ymd', $datetime);
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
        $coppied_remotefiles = array();
        if (is_object($data_source)) {
            $ftp_server_address = $data_source->ipaddress;
            $ftp_user_name = $data_source->loginname;
            $ftp_user_pass = $data_source->password;
            //$ftp_user_pass = '';
            $remote_file_creation_date = date('Ymd', $datetime);
//            $remote_file_path = $data_source->datalocation . '/' . $remote_file_creation_date;
            $remote_file_path = $remote_file_creation_date;
            $local_file_path = \Yii::$app->params['dataFileStorage']['seba'] . $data_source->name . '/' . $remote_file_creation_date . '/';
            ////creating a new folder to receive data files for a particular day
            Yii::trace('Creating a directory ' . $remote_file_creation_date . ' into the local server to keep the received files from ' . $ftp_server_address . ' ....', __METHOD__);
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
                $datasource_files_processed = $this->downloadRemoteFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path, $remote_file_creation_date);
                if (count($datasource_files_processed)) {
                    $coppied_remotefiles[$data_source->id] = $datasource_files_processed;
                }
            } catch (Exception $exc) {
                Yii::trace($exc->getTraceAsString(), __METHOD__);
            }
        }
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
                    $path = $data_source->datalocation . "\\" . $station->name . "\\" . Date('Y\\m') . "\\" . $station->name . "__SMSAWS__" . Date('Ymd') . '.txt';
                    $path = \Yii::$app->params['dataFileStorage']['vaisala'] . $data_source->name . '/' . $station->name . "/" . Date('Y/m') . "/" . $station->name . "__SMSAWS__" . Date('Ymd') . '.txt';
                    if ($this->ProcessVaisalaFile($path, $station)) {
                        $count++;
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
        $coppied_remotefiles = array();
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
                    Yii::trace('Creating a directory ' . $local_file_path . ' into the local server to keep the received files from ' . $ftp_server_address . ' ....', __METHOD__);
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
                        Yii::trace($exc->getTraceAsString(), __METHOD__);
                    }
                }
            }
        }
    }

    function downloadRemoteVaisalaFileToLocalPath($ftp_server_address, $ftp_user_name, $ftp_user_pass, $remote_file_path, $local_file_path) {
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

    //end of class
}
