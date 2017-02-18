<?php

namespace app\controllers;

use Yii;
use app\models\Station;
use app\models\StationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\StationWeatherElements;
use app\models\StationWeatherElementsSearch;
use app\models\User;
use app\models\UserSearch;
use yii\helpers\Html;

/**
 * StationController implements the CRUD actions for Station model.
 */
class StationController extends Controller {

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
     * Lists all Station models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new StationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Station model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $id = Html::encode($id);
        $model = $this->findModel($id);

        $searchModel_station_weather_element = new StationWeatherElementsSearch;
        $searchModel_station_weather_element->stationid = $model->id;
        $dataProvider_station_weather_element = $searchModel_station_weather_element->search(NULL);

        $searchModel_station_users = new UserSearch;
        $searchModel_station_users->stationid = $model->id;
        $dataProvider_station_users = $searchModel_station_users->search(NULL);

        if (isset($_POST['User'])) {
            $userModel = new User();
            $userModel->load(Yii::$app->request->post());
            $userModel->stationid = $id;
            $userModel->organizationid = $model->stationowner;
            $userModel->setPassword($userModel->password_hash);
            $userModel->status = User::STATUS_ACTIVE;
            $userModel->created_at = Date('Y-m-d H:i:s', time());
            $userModel->updated_at = $userModel->datedeactivated = $userModel->lastlogin = NULL;
            if ($userModel->save()) {
                $userRole = new \app\models\AuthAssignment;
                $userRole->item_name = 'Data Entry';
                $userRole->user_id = $userModel->id;
                $userRole->save();
            }
        }
        return $this->render('view', [
                    'model' => $model,
                    'dataProvider_station_weather_element' => $dataProvider_station_weather_element,
                    'searchModel_station_weather_element' => $searchModel_station_weather_element,
                    'dataProvider_station_users' => $dataProvider_station_users,
                    'searchModel_station_users' => $searchModel_station_users
        ]);
    }

    /**
     * Creates a new Station model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Station();

        if ($model->load(Yii::$app->request->post())) {
            $model->createdby = 2;
            $model->createdbyinsitutionid = 1;
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
     * Updates an existing Station model.
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
     * Deletes an existing Station model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Station model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Station the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Station::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
