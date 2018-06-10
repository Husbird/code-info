<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\ArticleCat;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for ArticleCat model.
 */
class CategoryController extends AppAdminController
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
     * Lists all ArticleCat models.
     * @return mixed
     */
    public function actionIndex()
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        $dataProvider = new ActiveDataProvider([
//            'query' => ArticleCat::find(), // ЛЕНИВАЯ ЗАГРУЗКА!!!
            'query' => ArticleCat::find()->with('category'), // ЖАДНАЯ ЗАГРУЗКА!!!
        ]);
        //debug($dataProvider);die;
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleCat model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleCat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        $model = new ArticleCat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('succes', 'Новая категория - "'  // НЕ РАБОТАЕТ флеш сообщение
                    . $model->title . '" успешно добавлена');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ArticleCat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ArticleCat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleCat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        // только АДМИНУ (временное решение)
        if ( (Yii::$app->user->isGuest ) || (Yii::$app->user->identity->adm_mss < 4) ) {
//            $model = new LoginForm();
            header('location:/site/login');
            exit();
        }
        
        if (($model = ArticleCat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
