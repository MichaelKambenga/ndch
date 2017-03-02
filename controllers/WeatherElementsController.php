<?php

namespace app\controllers;

use Yii;
use app\models\WeatherElements;
use app\models\WeatherElementsSearch;
use app\models\WeatherElementsList;
use app\models\WeatherElementsListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * WeatherElementsController implements the CRUD actions for WeatherElements model.
 */
class WeatherElementsController extends Controller {

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
     * Lists all WeatherElements models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new WeatherElementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeatherElements model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $id = Html::encode($id);
        $model = $this->findModel($id);
        //$condition = "elementid = {$id}";
        $model_elementList = new WeatherElementsList;
        $searchModel_elementList = new WeatherElementsListSearch;
        $searchModel_elementList->elementid = $model->id;
        $dataProvider_station = $searchModel_elementList->search(NULL);
        return $this->render('view', [
                    'model' => $model,
                    'dataElementList' => $dataProvider_station,
                    'searchElementList' => $searchModel_elementList,
                    'model_elements_list' => $model_elementList
        ]);
    }

    /**
     * Creates a new WeatherElements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new WeatherElements();

        if ($model->load(Yii::$app->request->post())) {
            $model->name = strtoupper($model->name);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeatherElements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->name = strtoupper($model->name);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WeatherElements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WeatherElements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeatherElements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = WeatherElements::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
