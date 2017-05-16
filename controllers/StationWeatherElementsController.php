<?php

namespace app\controllers;

use Yii;
use app\models\StationWeatherElements;
use app\models\StationWeatherElementsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * StationWeatherElementsController implements the CRUD actions for StationWeatherElements model.
 */
class StationWeatherElementsController extends \app\components\Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
        'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
        'delete' => ['GET'],
        ],
        ],
        ];
    }

    /**
     * Lists all StationWeatherElements models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StationWeatherElementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StationWeatherElements model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
        'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StationWeatherElements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id) {
        $id = Html::encode($id);
        $model = new StationWeatherElements();
        $model->stationid = $id;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['station/view', 'id' => $model->stationid]);
            }
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
     * Updates an existing StationWeatherElements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['station/view', 'id' => $model->stationid]);
        } else {
            return $this->render('update', [
            'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing StationWeatherElements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model) {
            $model->delete();
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the StationWeatherElements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StationWeatherElements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $id = Html::encode($id);
        if (($model = StationWeatherElements::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
