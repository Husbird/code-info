<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
//use yii\filters\AccessControl;
use Yii;
//use app\models\LoginForm;

class AppAdminController extends Controller {
    
    protected function admin_check() {
//        parent::__construct(null,null,null);
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 2) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
    }
    
}
