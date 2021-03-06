<?php

namespace app\commands;

use yii\console\Controller;
use app\models\AwsVaisala;
use app\models\WeatherData;

class AutomateController extends Controller {

    public function actionProcessVaisala() {
        //getting all AWS(file based) data sources
        $data_sources = \app\models\DataSources::find()->where(['datasourcetype' => \app\models\DataSources::DATA_SOURCE_FAILEBASED])->all();
        foreach ($data_sources as $data_source) {
            //getting all stations under each AWS(file based) data sources
            $data_source_stations = \app\models\DataSourceStations::findAll(['datasourceid' => $data_source->id]);
            $count = 0;
            foreach ($data_source_stations as $data_source_station) {
                $station = \app\models\Station::findOne($data_source_station->stationid);
                $path = $data_source->datalocation . "\\" . $station->name . "\\" . Date('Y', time()) . "\\" . Date('m', time()) . "\\" . $station->name . "_SMSAWS_" . Date('Ymd', time()) . '.txt';
                if ($this->ProcessVaisalaFile($path, $station)) {
                    $count++;
                }
            }
        }
    }

    public function ProcessVaisalaFile($path, $station) {
        $rows = file($path);
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
                if ($model->save()) {
                    ///insert data into common table ( weather data)
                    return $this->processWeatherData($model, WeatherData::AWS_VAISALA, $station->id);
                }
            }
        }
    }

    public function actionProcessSeba() {
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
    }

    public function ProcessSebaFile($path, $station) {
        $rows = file($path);
        foreach ($rows as $row) {
            $array_row = preg_split("/[\s,]+/", $row);

            //removing line terminator(;) in last item from the row
            $elements = count($array_row);
            if ($array_row[$elements - 2]) {
                $itemlegth = strlen($array_row[$elements - 2]);
                $array_row[$elements - 2] = substr($array_row[$elements - 2], 0, $itemlegth - 1);
            }
            //end removing line terminator(;) in last item from the row
            $model = new AwsSeba();
            $model->time = str_replace("T001:", "", $array_row[0]) . ' ' . $array_row[1];
            $model->time = Date('Y-m-d H:i:s', strtotime($model->time));
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

            if ($model->save()) {
                ///insert data into common table ( weather data)
                $this->processWeatherData($model, WeatherData::AWS_SEBA, $station->id);
            }
        }
    }

    function processWeatherData($data_dump_model, $aws_type, $station_id) {
        $weather_data = new WeatherData;
        $weather_data->stationid = $station_id;
        $weather_data->source = WeatherData::DATA_SOURCE_AWS_SYSTEM;
        $weather_data->EntryDate = $data_dump_model->EntryDate;
        switch ($aws_type) {
            case WeatherData::AWS_VAISALA:
                $weather_data->TIME = $data_dump_model->TIME;
                $weather_data->DP = $data_dump_model->DP;
                $weather_data->DP1HA = $data_dump_model->DP1HA;
                $weather_data->DP1HX = $data_dump_model->DP1HX;
                $weather_data->DP1HM = $data_dump_model->DP1HM;
                $weather_data->PA = $data_dump_model->PA;
                $weather_data->PA1HA = $data_dump_model->PA1HA;
                $weather_data->PA1HX = $data_dump_model->PA1HX;
                $weather_data->PA1HM = $data_dump_model->PA1HM;
                $weather_data->PR = $data_dump_model->PR;
                $weather_data->PR1HS = $data_dump_model->PR1HS;
                $weather_data->PR24HS = $data_dump_model->PR24HS;
                $weather_data->PR5MS00 = $data_dump_model->PR5MS00;
                $weather_data->PR5MS05 = $data_dump_model->PR5MS05;
                $weather_data->PR5MS10 = $data_dump_model->PR5MS10;
                $weather_data->PR5MS15 = $data_dump_model->PR5MS15;
                $weather_data->PR5MS20 = $data_dump_model->PR5MS20;
                $weather_data->PR5MS25 = $data_dump_model->PR5MS25;
                $weather_data->PR5MS30 = $data_dump_model->PR5MS30;
                $weather_data->PR5MS35 = $data_dump_model->PR5MS35;
                $weather_data->PR5MS40 = $data_dump_model->PR5MS40;
                $weather_data->PR5MS45 = $data_dump_model->PR5MS45;
                $weather_data->PR5MS50 = $data_dump_model->PR5MS50;
                $weather_data->PR5MS55 = $data_dump_model->PR5MS55;
                $weather_data->RH = $data_dump_model->RH;
                $weather_data->RH1HA = $data_dump_model->RH1HA;
                $weather_data->RH1HX = $data_dump_model->RH1HX;
                $weather_data->RH1HM = $data_dump_model->RH1HM;
                $weather_data->SR = $data_dump_model->SR;
                $weather_data->SR1HA = $data_dump_model->SR1HA;
                $weather_data->SR1HX = $data_dump_model->SR1HX;
                $weather_data->SR1HM = $data_dump_model->SR1HM;
                $weather_data->TA = $data_dump_model->TA;
                $weather_data->TA1HA = $data_dump_model->TA1HA;
                $weather_data->TA1HX = $data_dump_model->TA1HX;
                $weather_data->TA1HM = $data_dump_model->TA1HM;
                $weather_data->WD = $data_dump_model->WD;
                $weather_data->WD2MA = $data_dump_model->WD2MA;
                $weather_data->WD10MA = $data_dump_model->WD10MA;
                $weather_data->WD2MX = $data_dump_model->WD2MX;
                $weather_data->WD10MX = $data_dump_model->WD10MX;
                $weather_data->WD2MM = $data_dump_model->WD2MM;
                $weather_data->WD10MM = $data_dump_model->WD10MM;
                $weather_data->WD1HA = $data_dump_model->WD1HA;
                $weather_data->WD1HX = $data_dump_model->WD1HX;
                $weather_data->WD1HM = $data_dump_model->WD1HM;
                $weather_data->WS = $data_dump_model->WS;
                $weather_data->WS2MA = $data_dump_model->WS2MA;
                $weather_data->WS10MA = $data_dump_model->WS10MA;
                $weather_data->WS2MX = $data_dump_model->WS2MX;
                $weather_data->WS10MX = $data_dump_model->WS10MX;
                $weather_data->WS2MM = $data_dump_model->WS2MM;
                $weather_data->WS10MM = $data_dump_model->WS10MM;
                $weather_data->QFE = $data_dump_model->QFE;
                $weather_data->QFE1HA = $data_dump_model->QFE1HA;
                $weather_data->QFE1HX = $data_dump_model->QFE1HX;
                $weather_data->QFE1HM = $data_dump_model->QFE1HM;
                $weather_data->QFF = $data_dump_model->QFF;
                $weather_data->QFF1HA = $data_dump_model->QFF1HA;
                $weather_data->QFF1HX = $data_dump_model->QFF1HX;
                $weather_data->QFF1HM = $data_dump_model->QFF1HM;
                $weather_data->QNH = $data_dump_model->QNH;
                $weather_data->QNH1HA = $data_dump_model->QNH1HA;
                $weather_data->QNH1HX = $data_dump_model->QNH1HX;
                $weather_data->QNH1HM = $data_dump_model->QNH1HM;
                $weather_data->ETO = $data_dump_model->ETO;
                $weather_data->Path = $data_dump_model->Path;
                $weather_data->StationName = $data_dump_model->StationName;
                $weather_data->VaisalaVersion = $data_dump_model->VaisalaVersion;
                break;

            case WeatherData::AWS_SEBA:
                $weather_data->TIME = $data_dump_model->TIME;
                $weather_data->PA = $data_dump_model->P_L;
                $weather_data->PR = $data_dump_model->CH;
                $weather_data->RH = $data_dump_model->H_L;
                $weather_data->SR = $data_dump_model->G;
                $weather_data->TA = $data_dump_model->T_L;
                $weather_data->WD = $data_dump_model->D;
                $weather_data->WS = $data_dump_model->U;
                break;
            //add new case when new vendor for AWS available
        }
        $weather_data->save();
    }

}
