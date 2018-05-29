<?php

namespace app\controllers;

use yii\web\Controller;


class AppController extends Controller {
    
    // для активации пунктов меню:
    public $menu_main_active = '';
    public $menu_contact_active = '';
    public $menu_about_active = '';
    public $menu_article_active = '';
    
    protected function setMeta($title = null, $keywords = null, $description = null) {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

}
