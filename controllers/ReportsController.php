<?php

namespace app\controllers;

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

}
