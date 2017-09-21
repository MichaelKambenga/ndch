<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;

class ReportsController extends \yii\web\Controller {

    // Privacy statement output demo
    public function actionIndex() { {

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'content' => $this->renderPartial('report1'),
                'options' => [
                    'title' => 'Privacy Policy - Krajee.com',
                    'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
                ],
                'methods' => [
                    'SetHeader' => ['Generated On: ' . date("r")],
                    'SetFooter' => ['|Page {PAGENO}|'],
                ]
            ]);
            return $pdf->render();
        }
    }

    public function actionReportFilterForm() {

        $model = new \app\models\ReportFilterForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $date = $model->date . "%";

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);
//                return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml');
//                $query = "select " . '"TIME"' .  "as date," . '"PA"' . " from tbl_weather_data";
                $query = "select " . '"name"' . "as station_name, AVG(cast(" . '"TA"' . " as double precision)) as temperature
from
tbl_station a
inner join
tbl_weather_data b
on a.id=b.stationid
where " . '"TIME"' . " like '$date'
group by " . '"name"' .
                        " order by " . '"name"' . "";

//                echo $query;
//                die();

                $reportico = \Yii::$app->getModule('reportico');
                $engine = $reportico->getReporticoEngine();
                $engine->initial_execute_mode = "PREPARE";
                $engine->access_mode = "REPORTOUTPUT";
                $engine->initial_project = "NdchReports";
                $engine->initial_project_password = "@User123"; // If project password required
                $engine->initial_sql = $query;
                $engine->set_attribute("ReportTitle", "Daily Average Report");
                $engine->initial_show_criteria = "hide";
                $engine->clear_reportico_session = true;
                $engine->show_refresh_button = true;
                $engine->set_report_title = "Halla";
                $engine->execute();

//                $reportico = \Yii::$app->getModule('reportico');
//                $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
//                $engine->access_mode = "REPORTOUTPUT";             // Allows access to report output only
//                $engine->initial_execute_mode = "PREPARE";         // Just executes specified report
//                $engine->initial_project = "northwind";            // Name of report project folder    
//                $engine->initial_report = "salestotals";           // Name of report to run
//                $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
//                $engine->force_reportico_mini_maintains = true;    // Often required
//                $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
//                $engine->clear_reportico_session = true;           // Normally required
//                $engine->execute();
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

    public function actionDailyAvgValues() {

        $model = new \app\models\ReportFilterForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $date = $model->date . "%";

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);

                if ($model->geo_level == "AllStations") {
                    return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&report=DailyAvgRptPerStation.xml&AvgDate=2015-08-11');
                }
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

    public function actionDailyOptimalValues() {
        $model = new \app\models\ReportFilterForm();
        //echo $model->date; die();
        $query = \app\models\WeatherData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'TIME' => SORT_DESC,
                ]
            ],
        ]);

        if ($model->load(Yii::$app->request->post())) {
            //echo 'hapa'; die();
            $query = \app\models\WeatherData::find()->where(['TIME' => '2016-06-03 03:28:00']);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'TIME' => SORT_DESC,
                    ]
                ],
            ]);
            return $this->render('AvgValues', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('AvgValues', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRangeAvgValues() {

        $model = new \app\models\ReportFilterForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $date = $model->date . "%";

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);
                return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml');
//                $query = "select " . '"TIME"' .  "as date," . '"PA"' . " from tbl_weather_data";
//                $query = "select " . '"name"' . "as station_name, AVG(cast(".'"TA"'." as double precision)) as temperature
//from
//tbl_station a
//inner join
//tbl_weather_data b
//on a.id=b.stationid
//where ".'"TIME"'." like '$date'
//group by " . '"name"' .
//                        " order by " . '"name"' . "";
//
////                echo $query;
////                die();
//
//                $reportico = \Yii::$app->getModule('reportico');
//                $engine = $reportico->getReporticoEngine();
//                $engine->initial_execute_mode = "PREPARE";
//                $engine->access_mode = "REPORTOUTPUT";
//                $engine->initial_project = "NdchReports";
//                $engine->initial_project_password = "@User123"; // If project password required
//                $engine->initial_sql = $query;
//                $engine->set_attribute("ReportTitle", "Daily Average Report");
//                $engine->initial_show_criteria = "hide";
//                $engine->clear_reportico_session = true;
//                $engine->show_refresh_button = true;
//                $engine->set_report_title = "Halla";
//                $engine->execute();
//                $reportico = \Yii::$app->getModule('reportico');
//                $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
//                $engine->access_mode = "REPORTOUTPUT";             // Allows access to report output only
//                $engine->initial_execute_mode = "PREPARE";         // Just executes specified report
//                $engine->initial_project = "northwind";            // Name of report project folder    
//                $engine->initial_report = "salestotals";           // Name of report to run
//                $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
//                $engine->force_reportico_mini_maintains = true;    // Often required
//                $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
//                $engine->clear_reportico_session = true;           // Normally required
//                $engine->execute();
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

    public function actionRangeOptimalValues() {

        $model = new \app\models\ReportFilterForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $date = $model->date . "%";

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);
//                return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml');
//                $query = "select " . '"TIME"' .  "as date," . '"PA"' . " from tbl_weather_data";
                $query = "select " . '"name"' . "as station_name, AVG(cast(" . '"TA"' . " as double precision)) as temperature
from
tbl_station a
inner join
tbl_weather_data b
on a.id=b.stationid
where " . '"TIME"' . " like '$date'
group by " . '"name"' .
                        " order by " . '"name"' . "";

//                echo $query;
//                die();

                $reportico = \Yii::$app->getModule('reportico');
                $engine = $reportico->getReporticoEngine();
                $engine->initial_execute_mode = "PREPARE";
                $engine->access_mode = "REPORTOUTPUT";
                $engine->initial_project = "NdchReports";
                $engine->initial_project_password = "@User123"; // If project password required
                $engine->initial_sql = $query;
                $engine->set_attribute("ReportTitle", "Daily Average Report");
                $engine->initial_show_criteria = "hide";
                $engine->clear_reportico_session = true;
                $engine->show_refresh_button = true;
                $engine->set_report_title = "Halla";
                $engine->execute();

//                $reportico = \Yii::$app->getModule('reportico');
//                $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
//                $engine->access_mode = "REPORTOUTPUT";             // Allows access to report output only
//                $engine->initial_execute_mode = "PREPARE";         // Just executes specified report
//                $engine->initial_project = "northwind";            // Name of report project folder    
//                $engine->initial_report = "salestotals";           // Name of report to run
//                $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
//                $engine->force_reportico_mini_maintains = true;    // Often required
//                $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
//                $engine->clear_reportico_session = true;           // Normally required
//                $engine->execute();
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

    public function actionDailyTrends() {

        $model = new \app\models\ReportFilterForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                $date = $model->date . "%";

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);
//                return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml');
//                $query = "select " . '"TIME"' .  "as date," . '"PA"' . " from tbl_weather_data";
                $query = "select " . '"name"' . "as station_name, AVG(cast(" . '"TA"' . " as double precision)) as temperature
from
tbl_station a
inner join
tbl_weather_data b
on a.id=b.stationid
where " . '"TIME"' . " like '$date'
group by " . '"name"' .
                        " order by " . '"name"' . "";

//                echo $query;
//                die();

                $reportico = \Yii::$app->getModule('reportico');
                $engine = $reportico->getReporticoEngine();
                $engine->initial_execute_mode = "PREPARE";
                $engine->access_mode = "REPORTOUTPUT";
                $engine->initial_project = "NdchReports";
                $engine->initial_project_password = "@User123"; // If project password required
                $engine->initial_sql = $query;
                $engine->set_attribute("ReportTitle", "Daily Average Report");
                $engine->initial_show_criteria = "hide";
                $engine->clear_reportico_session = true;
                $engine->show_refresh_button = true;
                $engine->set_report_title = "Halla";
                $engine->execute();

//                $reportico = \Yii::$app->getModule('reportico');
//                $engine = $reportico->getReporticoEngine();        // Fetches reportico engine
//                $engine->access_mode = "REPORTOUTPUT";             // Allows access to report output only
//                $engine->initial_execute_mode = "PREPARE";         // Just executes specified report
//                $engine->initial_project = "northwind";            // Name of report project folder    
//                $engine->initial_report = "salestotals";           // Name of report to run
//                $engine->bootstrap_styles = "3";                   // Set to "3" for bootstrap v3, "2" for V2 or false for no bootstrap
//                $engine->force_reportico_mini_maintains = true;    // Often required
//                $engine->bootstrap_preloaded = true;               // true if you dont need Reportico to load its own bootstrap
//                $engine->clear_reportico_session = true;           // Normally required
//                $engine->execute();
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

    public function actionAvgValues() {
        $model = new \app\models\ReportFilterForm();
        //echo $model->date; die();
        $query = \app\models\WeatherData::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'TIME' => SORT_DESC,
                ]
            ],
        ]);

        if ($model->load(Yii::$app->request->post())) {
            //echo 'hapa'; die();
            if ($model->date) {
                $date = $model->date;
            }
                                         
            $query = \app\models\WeatherData::find()->where(['like', 'TIME', $date]);

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'defaultOrder' => [
                        'TIME' => SORT_DESC,
                    ]
                ],
            ]);
            return $this->render('AvgValues', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('AvgValues', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionRegStations() {
        $model = new \app\models\ReportFilterForm();
        $query = \app\models\Station::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [

            ],
        ]);

        if ($model->load(Yii::$app->request->post())) {
            //echo 'hapa'; die();
            if ($model->date) {
                $date = $model->date;
            }
                                         

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
        
                ],
            ]);
            return $this->render('RegStations', [
                        'model' => $model,
                        'dataProvider' => $dataProvider,
            ]);
        }
        return $this->render('RegStations', [
                    'model' => $model,
                    'dataProvider' => $dataProvider,
        ]);
    }

}



