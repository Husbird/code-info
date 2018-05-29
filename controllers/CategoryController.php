<?php

namespace app\controllers;

use Yii;
use app\models\ArticleCat;
use app\models\Article;
use yii\data\Pagination;
use yii\web;
use yii\helpers\Html;

class CategoryController extends AppController {
    
    public function actionView() {
        // выделяем пункт меню
        $this->menu_article_active = 'active';
        
        $id = Yii::$app->request->get('id');
        $category = ArticleCat::findOne($id);
        if(empty($category)) {
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }
//        Образец
//        $articles = Article::find()->asArray()
//                //->with('articleCategory')
//                ->where(['category_id' => $id])
//                ->orderBy( ['id' => SORT_DESC] )
//                ->all();
//        Пагинация:
        $query = Article::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 9,
            'forcePageParam' => false,
            'pageSizeParam' => false,
            ]);
        $articles = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
        //debug($category->title);die;
        
        // Устанавливаем метатеги с помощью своего метода в общем контроллере:
        $this->setMeta($category->title,$category->keywords,$category->description);
        
        return $this->render('view', compact('articles', 'pages', 'category'));
     }
     
     public function actionSearch() {
  
        $q = Html::encode(trim( Yii::$app->request->get('q')) );
//       Устанавливаем метатеги с помощью своего метода в общем контроллере:
        $this->setMeta("Поиск: ".$q);
        if (!$q) {
            return $this->render('search');
        }
//        Пагинация:
        $query = Article::find()->where(['like', 'title', $q]);
        $pages = new Pagination([
            'totalCount' => $query->count(), 
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false,
            ]);
        $articles = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
        //debug($category->title);die;
        return $this->render('search', compact('articles', 'pages', 'q'));
     }
}
