<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Logins;
use app\models\UserAuditTrail;
use app\models\LoginsSearch;
use app\models\UserAuditTrailSearch;
use yii\helpers\Html;
use app\models\AuthAssignment;
use yii\base\ActionFilter;
use yii\base\AccessFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends \app\components\Controller {

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $id = Html::encode($id);
        $model = $this->findModel($id);
        $model_logins = new Logins;
        $model_login_search = new LoginsSearch;
        $model_login_search->userid = $model->id;
        $dataProviderLogins = $model_login_search->search(NULL);

        $model_audit = new UserAuditTrail;
        $model_audit_search = new UserAuditTrailSearch;
        $model_audit_search->userid = $model->id;
        $dataProviderAuditTrail = $model_audit_search->search(NULL);

        return $this->render('view', [
        'model' => $model,
        'model_logins' => $model_logins,
        'model_login_search' => $model_login_search,
        'dataProviderLogins' => $dataProviderLogins,
        'model_audit' => $model_audit,
        'model_audit_search' => $model_audit_search,
        'dataProviderAuditTrail' => $dataProviderAuditTrail,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new User;
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_hash);
            $model->status = User::STATUS_ACTIVE;
            $model->created_at = Date('Y-m-d H:i:s', time());
            $model->updated_at = $model->datedeactivated = $model->lastlogin = NULL;
            if ($model->user_role && $model->user_role == 'Station User') {
                $model->scenario = User::SCENARIO_STATION_USER;
            }

            if ($model->save()) {
                $userRole = new AuthAssignment;
                $userRole->item_name = $model->user_role;
                $userRole->user_id = $model->id;
                $userRole->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->updated_at = Date('Y-m-d H:i:s', time());
        //getting user roles
        $user_roles=AuthAssignment::findone(['user_id' => $model->id]); //->where();
        if ($user_roles && isset($user_roles->item_name)) {
            $model->user_role = $user_roles->item_name;
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->user_role && $model->user_role == 'Station User') {
                $model->scenario = User::SCENARIO_STATION_USER;
            }
            if ($model->save()) {
                AuthAssignment::deleteAll(['user_id' => $model->id]);
                $userRole = new AuthAssignment;
                $userRole->item_name = $model->user_role;
                $userRole->user_id = $model->id;
                $userRole->created_at = time();
                $userRole->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if ($model) {
            AuthAssignment::delete()->where(['user_id' => $model->id])->all();
            $model->delete();
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
