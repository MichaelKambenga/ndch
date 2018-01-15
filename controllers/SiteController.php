<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\WeatherData;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout','contact','about','account-profile','account-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
//                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        if (!\Yii::$app->user->isGuest) {
            $content = array();
            ///TOP 5 REPORTING STATIONS 
            $top_reporting_stations = "select stationid, count(stationid) as counts from tbl_weather_data group by stationid order by counts desc limit 5";
            $content['top_reporting_stations'] = WeatherData::findBySql($top_reporting_stations)->all();
            ///TOP 5 LATEST OBSERVATION REPORTING STATIONS   
            $latest_observation_sql = 'select MAX("TIME") AS "TIME", stationid from tbl_weather_data group by stationid order by "TIME" desc limit 5';
            $content['recent_observations'] = WeatherData::findBySql($latest_observation_sql)->all();
            return $this->render('index', $content);
        } else {
            return $this->redirect(['/site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
           
            if (!is_null(\yii::$app->user->identity->organizationid) && is_null(\yii::$app->user->identity->stationid)) {
                Yii::$app->session->set('organizationUser', 1);
            }
            if (!is_null(\yii::$app->user->identity->stationid)) {
                Yii::$app->session->set('stationUser', 1);
            }
            /* Logs the Logins History */
            $loginsModel = new \app\models\Logins();
            $loginsModel->userid = \yii::$app->user->identity->id;
            $loginsModel->ipaddress = Yii::$app->getRequest()->getUserIP();
            $loginsModel->details = 'User logged into the system successful using browser :- ' . Yii::$app->getRequest()->getUserAgent();
            $loginsModel->save();
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        /* Logs the Logins History */
        $loginsModel = new \app\models\Logins();
        $loginsModel->userid = Yii::$app->user->id;
        $loginsModel->ipaddress = Yii::$app->getRequest()->getUserIP();
        $loginsModel->details = 'User logged out the system successful using browser :- ' . Yii::$app->getRequest()->getUserAgent();
        $loginsModel->save();
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /*
     * Change Password action
     */

    public function actionAccountProfile() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->user->id;
        $model = \app\models\User::find()->where('id =:id')->addParams([':id' => $id])->one();
        return $this->render('profile', ['model' => $model]);
    }

    /*
     * Change Password action
     */

    public function actionAccountPassword() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $id = Yii::$app->user->id;
        $model = \app\models\User::find()->where('id =:id')->addParams([':id' => $id])->one();
        if ($model) {
            $model->scenario = 'account_password_change';
            if ($model->load(Yii::$app->request->post())) {
                $user = Yii::$app->request->post('User');
                //var_dump($user);
                $model->current_password = $user['current_password'];
                $model->new_password = $user['new_password'];
                $model->new_repeat_password = $user['new_repeat_password'];
                $model->user_role = 1;
                if ($model->validate()) {
                    echo $model->new_password;
                    exit;
                    $model->setPassword($model->new_password);
                    
                    if ($model->save()) {
                        $this->redirect('site/account-profile');
                    }
                }
                //echo '=='.$model->current_password.'=new>='.$model->new_password.'=Repeat='.$model->new_repeat_password;
                exit;
            }
            return $this->render('password', ['model' => $model]);
        } else {
            return $this->goHome();
        }
    }

    /**
     * Displays forbidden page.
     *
     * @return string
     */
    public function actionForbidden() {
        return $this->render('forbidden');
    }

}
