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

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
            $user_roles = $model->user_role;
            if (count($user_roles) > 0 && isset($user_roles['Station User'])) {
                $model->scenario = User::SCENARIO_STATION_USER;
            }

            if ($model->save()) {
                foreach ($user_roles as $key => $role) {
                    $userRole = new AuthAssignment;
                    $userRole->item_name = $role;
                    $userRole->user_id = $model->id;
                    $userRole->save();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $model->user_role = $user_roles;
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
//        $user_role=array();
//        $user_roles=AuthAssignment::find()->where(['user_id' => $model->id])->all();
//        if($user_roles){
//            foreach($user_roles as $role){
//              array_push($user_role, $role->item_name); 
//            }
//            $model->user_role=$user_role;
//        }
        $model->updated_at = Date('Y-m-d H:i:s', time());
        if ($model->load(Yii::$app->request->post())) {
            $user_roles = $model->user_role;
            if ($model->save()) {
                $count_roles = 0;
                AuthAssignment::deleteAll(['user_id' => $model->id]);
                foreach ($user_roles as $key => $role) {
                    $userRole = new AuthAssignment;
                    $userRole->item_name = $role;
                    $userRole->user_id = $model->id;
                    $userRole->created_at = time();
                    if ($userRole->save()) {
                        $count_roles++;
                    }
                }
                if ($count_roles) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }{
                  $model->user_role=$user_roles;
                }
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
