<?php

namespace app\controllers;

use Yii;
use app\models\DataSources;
use app\models\DataSourcesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use app\models\DataSourceStations;
use app\models\DataSourceStationsSearch;

/**
 * DataSourcesController implements the CRUD actions for DataSources model.
 */
class DataSourcesController extends \app\components\Controller {

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
     * Lists all DataSources models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new DataSourcesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataSources model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $id = \yii\bootstrap\Html::encode($id);
        $model = $this->findModel($id);
        $stations_model = new DataSourceStationsSearch;
        $stations_model->datasourceid = $model->id;
        $dataProvider_stations = $stations_model->search(NULL);
        return $this->render('view', [
        'model' => $model,
        'stations_model' => $stations_model,
        'dataProvider_stations' => $dataProvider_stations
        ]);
    }

    /**
     * Creates a new DataSources model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new DataSources();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
            'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DataSources model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } 
        return $this->render('update', [
          'model' => $model,
        ]);
        
    }

    /**
     * Deletes an existing DataSources model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataSources model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataSources the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $id = \yii\bootstrap\Html::encode($id);
        if (($model = DataSources::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddStation($id) {
        $id=Html::encode($id);
        $model =new DataSourceStations;
        $model->datasourceid=$id;
        $datamodel=DataSourceStations::findAll(array('datasourceid'=>$id));
       
         if ($model->load(Yii::$app->request->post())) {
            // $stations=Yii::$app->request->post('DataSourceStations');
             $model->stations=$model->stationid;
             //var_dump($model->stations);
             $countclean=$countdata=0;
             $countdata=count($model->stations);
             if($countdata){
               foreach($model->stations as $station){
                   $modelsave=new DataSourceStations;
                   $modelsave->stationid= $station;
                   $modelsave->datasourceid=$id;
                   $modelsave->stations=$countdata;
                   //validating each record
                   if($modelsave->validate()){
                       $countclean++;
                   }
                   
               }
             }
              if ($countclean && $countdata && ($countclean==$countdata)) {
                $countclean=0;
                foreach($model->stations as $station){
                   $modelsaving=new \app\models\DataSourceStations;
                   $modelsaving->stationid= $station;
                   $modelsaving->datasourceid=$id;
                   $modelsaving->stations=$countdata;
                   $modelsaving->datecreated=Date('Y-m-d H:i:s',time());
                   //validating each record
                   if($modelsaving->save()){
                       $countclean++;
                   }
                   
               }
               if($countclean==$countdata){
                   return $this->redirect(['view', 'id' => $model->datasourceid]);
                }
              }
        }
        return $this->render('add_station', [
        'model' => $model,
        ]);
    }

}
