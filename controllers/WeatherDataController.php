<?php

namespace app\controllers;

use Yii;
use app\models\WeatherData;
use app\models\WeatherDataSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WeatherDataController implements the CRUD actions for WeatherData model.
 */
class WeatherDataController extends \app\components\Controller {

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
     * Lists all WeatherData models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WeatherDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeatherData model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new WeatherData model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new WeatherData();
        if ($model->load(Yii::$app->request->post())) {
            $model->stationid = NULL;
            $model->source = WeatherData::DATA_DOURCE_MANNED_SYSTEM;
            if (\yii::$app->user->identity->stationid) {
                $model->stationid = \yii::$app->user->identity->stationid;
            }
            $model->TIME = explode(' ', $model->TIME);
            if (count($model->TIME) && isset($model->TIME[1]) && isset($model->TIME[4])) {
                $date = $model->TIME[1];
                $date = explode('-', $date);
                $date = $date[2] . '-' . $date[1] . '-' . $date[0];
                $model->TIME = trim($date . ' ' . $model->TIME[4]);
            } else {
                $model->TIME = NULL;
            }
            echo $model->TIME;
            $model->EntryDate = Date('Y-m-d H:i:s', time());

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeatherData model.
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
     * Deletes an existing WeatherData model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WeatherData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeatherData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = WeatherData::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   

}
