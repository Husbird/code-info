<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use yii\data\ActiveDataProvider;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\ArticleCat;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends AppAdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->admin_check();
        
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->with('articleCategory'),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'views' => SORT_DESC
                ],
            ],
        ]);
        
//        $category = Article_cat::find()->asArray()
//                //->with('articleCategory')
////                ->where(['category_id' => $id])
////                ->orderBy( ['id' => SORT_DESC] )
//                ->all();
//debug($dataProvider);die;
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            //'category' => $category,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->admin_check();
        
        return $this->render('view', [
            //'model' => $this->findModel($id),
            'model' => Article::find()->with('articleCategory')
                ->where(['id' => $id])
                ->limit(1)
                ->one(),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->admin_check();
        
        $model = new Article();
//        if ( $model->load( Yii::$app->request->post()) ) {
//            $x = $model->save();
//            debug($model);
//            die;
//        }

//        $model->save();
//        debug($model);
//        die;
        if ($model->load( Yii::$app->request->post() ) && $model->save() ) {
            if ( true === $model->create_dir($model->id) ) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                die('Не удалось создать директории...');
            }
//            debug($model->title);
//            die;
//            return $this->redirect(['view', 'id' => $model->id]);
        }
        
//        Готовим массив для выпадающего списка:
        $categoryArray = ArticleCat::find()->asArray()->all();
//        Получаем массив-дерево конечных категорий (у которых нет Child-дов)
        $mainCategoriesTree = getMainCategoriesTree($categoryArray);
//        Получаем массив с id конечных категорий и строкой - описанием их иерархии (для выпадающего списка)
        $categoryList = getCategoryList($mainCategoriesTree);

        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->admin_check();
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        
//        Готовим массив для выпадающего списка:
        $categoryArray = ArticleCat::find()->asArray()->all();
//        Получаем массив-дерево конечных категорий (у которых нет Child-дов)
        $mainCategoriesTree = getMainCategoriesTree($categoryArray);
        //debug($mainCategoriesTree);die();
//        Получаем массив с id конечных категорий и строкой - описанием их иерархии (для выпадающего списка)
        $categoryList = getCategoryList($mainCategoriesTree);
        //debug($categoryList);die();

        $model->title = Yii::$app->formatter->asHtml($model->title);
        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->admin_check();
        
        $dir_path = './upload/global/article/'.$id.'/';
        
        if ( true === $this->findModel($id)->drop_dir($dir_path) ) {
            $this->findModel($id)->delete();
        } else {
            die ('Удалить каталоги не удалось!');
        }     
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $this->admin_check();
        
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
}
