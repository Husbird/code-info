<?php

namespace app\controllers;

//use yii\filters\AccessControl;
//use yii\web\Response;
//use yii\filters\VerbFilter;
use Yii;
use app\models\ArticleCat;
use app\models\Article;
use yii\data\Pagination;

class ArticleController extends AppController {
    
    public function actionView() {
        
        $this->menu_article_active = 'active';
        
        $id = Yii::$app->request->get('id');
        
        // ленивая загрузка:
//        $article = Article::findOne($id);
        
        // жадная загрузка:
//        articleCategory - заранее подготовленный метов в модели Article
        $article = Article::find()->with('articleCategory')
                ->where(['id' => $id])
                ->limit(1)
                ->one();
        if( empty($article) ) {
            throw new \yii\web\HttpException(404, 'Такой статьи нет');
        }

        //debug($category_id); die;
//        $articleForCarusel = Article::find()
//                ->asArray()
//                ->where('category_id=$category_id')
//                ->limit(4)
//                ->all();
//            
//        Для карусели:
//        $category_id = $article->articleCategory['id'];
//        $sql = "SELECT * FROM `article` WHERE category_id = :category_id LIMIT 4";
//        $articleForCarusel = Article::findBySql($sql, [':category_id' => $category_id])->all();
        //debug($articleForCarusel); die;
        //
        // Устанавливаем метатеги с помощью своего метода в общем контроллере:
        $this->setMeta($article->title,$article->keywords,$article->description);
        
        // готовим данные для микроразметки:
        $site_path = 'code-info.loc';
        $micro['datePublished'] = date(DATE_ISO8601, $article->date_add);
        $micro['dateModified'] = date(DATE_ISO8601, $article->date_edit);
//        $article->micro->datePublished = date(DATE_ISO8601, $article->date_add);
//        $article->micro->dateModified = date(DATE_ISO8601, $article->date_edit);
//        $Hfu = new Hfu;
        // постоянный адрес страницы
        $micro['mainEntityOfPageUrl'] = $site_path.'/article/'.$article->title.'/'.$article->id;
        $micro['logoImgUrl'] = $site_path.'/web/images/main/mss_logo.png'; // адрес логотипа
//        $article->micro->mainEntityOfPageUrl = $site_path.'/article/'.$article->title.'/'.$article->id;
//        $article->micro->logoImgUrl = $site_path.'/web/images/main/mss_logo.png'; // адрес логотипа
        
//        Если с каруселью:
//        return $this->render( 'view', compact('article', 'articleForCarusel') );
//        Если без карусели:
        return $this->render( 'view', compact('article', 'micro') );
    }
    
    public function actionArticleMain() {
        
        $this->menu_article_active = 'active';
        
        $this->view->title = 'Разделы статей';

        /*
        Выполняем запрос к БД:
        1 шаг: метод find() - находит объект запроса
        2 шаг: настройка объекта запроса например метод-построитель запроса
            порядок написания данных методов не имеет значения
        3 шаг: получение данных запроса в виде объектов\массивов например метод - all() (аналог селекта со звёздочкой)
        */
//        $parts = Article_part::find()->all();
//        $parts = Article_part::find()->orderBy( ['id' => SORT_ASC] )->all();
//        $parts = Article_part::find()->orderBy( ['id' => SORT_DESC] )->all();
//        $parts = Article_part::find()->asArray()->where('id=1')->all();
//        $parts = Article_part::find()->asArray()->where(['title' => 'Софт'])->all();
//        $parts = Article_part::find()->asArray()->where(['like', 'keywords', 'php'])->all();
//        $parts = Article_part::find()->asArray()->where(['>=', 'id', '3'])->all();
//        $parts = Article_part::find()->asArray()->limit(3)->all();
//        $parts = Article_part::find()->asArray()->limit(1)->one();
//        $parts = Article_part::find()->asArray()->where(['>=', 'id', '3'])->count();
//        $parts = Article_part::findOne()->where(['>=', 'id', '3']); // только объект
//        $parts = Article_part::findAll();
//        $parts = Article_part::findAll()->where(['>=', 'id', '3']); // только объект
//        
//        $sql = "SELECT * FROM `article_part` WHERE keywords LIKE '%php%'";
//        $parts = Article_part::findBySql($sql)->all();
        
//        Подготовленный запрос
//        $searchString = "%php%";
//        $sql = "SELECT * FROM `article_part` WHERE keywords LIKE :search";
//        $parts = Article_part::findBySql($sql, [':search' => $searchString])->all();
        
        //$parts = ArticleCat::find()->asArray()->where(['parent' => 0])->all();
        //        Пагинация:
        $query = Article::find()
                ->with('articleCategory')
                ->orderBy( ['id' => SORT_DESC] );
//                ->all();
                //->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 8,
            'forcePageParam' => false,
            'pageSizeParam' => false,
            ]);
        $articles = $query
                ->offset($pages->offset)
                ->limit($pages->limit)
                ->asArray()
                ->all();
        $article_page['title'] = 'Раздел статей';
        $article_page['keywords'] = 'Компьютеры, программирование, железо, процессоры, видеокарты, озу, ипб';
        $article_page['main_page_description'] = 'Все статьи';
        //debug($articles);die;
        
        
        // Устанавливаем метатеги с помощью своего метода в общем контроллере:
        $this->setMeta($article_page['title'],$article_page['keywords'],$article_page['main_page_description']);
        
        return $this->render('article_main', compact('articles', 'pages', 'article_page'));
        
        
        
        //return $this->render( 'article_main', compact('parts') );
     }
}
