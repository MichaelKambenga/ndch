<?php

namespace app\controllers;

use Yii;
use app\models\Stakeholder;
use app\models\StakeholderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Station;
use app\models\StationSearch;
use app\models\DataSourcesSearch;
use yii\helpers\Html;

/**
 * StakeholderController implements the CRUD actions for Stakeholder model.
 */
class StakeholderController extends \app\components\Controller {

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
     * Lists all Stakeholder models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StakeholderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stakeholder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $id = Html::encode($id);    //Why this   
        $model = $this->findModel($id);

        $model_station = new Station;
        $model_station_search = new StationSearch;
        $model_data_source_search = new DataSourcesSearch();
        $model_station_search->stationowner = $model->id;
        $dataProviderStation = $model_station_search->search(NULL);
        $model_data_source_search->stakeholderid = $model->id;
//        $dataProviderDataSources = $model_data_source_search->search(NULL);    
        return $this->render('view', [
                    'model' => $model,
                    'model_station' => $model_station,
                    'model_station_search' => $model_station_search,
                    'model_data_source_search' => $model_data_source_search,
                    'dataProvider_station' => $dataProviderStation,
                    'dataProvider_datasources' => $dataProviderDataSources,
        ]);
    }

    /**
     * Creates a new Stakeholder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Stakeholder();

        if ($model->load(Yii::$app->request->post())) {
            $model->datecreated = Date('Y-m-d h:i:sa');

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stakeholder model.
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
     * Deletes an existing Stakeholder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);

        $model->status = Stakeholder::ORG_STATUS_INACTIVE;
        $model->datedeactivated = Date('Y-m-d h:i:sa');

        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stakeholder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stakeholder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Stakeholder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
