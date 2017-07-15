<?php

namespace app\components;

use yii\web\ForbiddenHttpException;

class Controller extends \yii\web\Controller {

    public function beforeAction($action) {
        $controller = \Yii::$app->controller->id;
        $action = \Yii::$app->controller->action->id;
        $controller_action = "/" . \Yii::$app->controller->id . "/" . $action;
        if (\Yii::$app->user->can($controller_action)) {
            return true;
        } else {
            $this->redirect(['/site/forbidden']);
        }
    }

}
