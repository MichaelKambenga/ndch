<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;

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

                // form inputs are valid, do something here
//                return $this->redirect(['reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml']);
//                return $this->redirect(['reportico/mode/prepare&project=crr&project_password=password&new_reportico_window=1&report=all_contracts.xml']);

                return $this->redirect('http://localhost:8080/ndch/web/index.php?r=reportico/mode/prepare&project=NdchReports&project_password=@User123&new_reportico_window=1&report=DailyAvgRptPerStation.xml');
            }
        }
        return $this->render('ReportFilterForm', [
                    'model' => $model,
        ]);
    }

}
