<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Site;
//use app\models\Article_part;

class SiteController extends AppController
{
    /*
    подключение шаблона локально (только для текущего контроллера)
    public $layout = 'main';
    */

    /*
    Mетод (фильтр), для указания действий, выполняемых пере отрабатыванием 
    текущего экшена (также еще есть afterAction()):
        public function beforeAction() {
            // тут например отключим CSRF валидацию (по токену из шаблона <?= Html::csrfMetaTags() ?>)
            if ( $action->id == 'index' ) {
                $this->enableCsrfValidation = false;
            }
        }
        */

    /**
     * {@inheritdoc}
     */
    
    
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
//                        Действие logout разрешено только для авторизированных (@)
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    
                    [
//                        Действие login разрешено только для НЕ авторизированных (?)
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    // параметры в екшене - переменные из GET запроса
    public function actionIndex($getVar1 = null, $getVar2 = null)
    {
        /*
        подключение шаблона локально (только для текущего Action!)
        $this->layout = 'simplex';
        */

        /*
        параметры из GET запроса
        $param1 = $getVar1; $param2 = $getVar2;
        */

        /*Принимаем AJAX запрос:
        if ( Yii::$app->request->isAjax ) {
            // можно также проверить массивы post\get:
            var_dump($_POST);
            // получение содержимого массивов post\get средствами Yii:
            var_dump(Yii::$app->request->post);
            // переменная test - та, которую отправляли:
            return 'test';
        }*/
        
        $page_content = Site::find()
                ->where(['id' => 1])
                ->limit(1)
                ->asArray()
                ->one();
        if( empty($page_content) ) {
            throw new \yii\web\HttpException(404, 'Такой статьи нет');
        }
        //debug($page_content['title']);
        // тег title страницы 
        $this->view->title = $page_content['title'];
        // задаем метатеги
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $page_content['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $page_content['meta_description']]
        );

        // Вызываем вид и передаём в него переменные (2 способа)
        //$test = "Hello World";
        //$test2 = "Hello World2";
        $this->menu_main_active = 'active';
        // переменные будут доступны из вида по именам var1 и var2
        //return $this->render('index', ['var1' => $test, 'var2' => $test2]);
        // переменные будут доступны из вида по именам test и test2
        return $this->render( 'index', compact( 'menu_index', 'page_content', 'menu_current' ) );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        //echo Yii::$app->getSecurity()->generatePasswordHash('10510560');die; 7k)9(Dj9WAl^@aY%j&e@p1,
        //echo Yii::$app->getSecurity()->generatePasswordHash('7k)9(Dj9WAl^@aY%j&e@p1,');die;
//        Проверка, не является ли пользователь гостем?
        if (!Yii::$app->user->isGuest) {
//            Если не гость - отправляем на главную страницу
            return $this->goHome();
        }
//        Если гость - создаём экземпляр модели LoginForm
        $model = new LoginForm();
//        Загружаем в неё данные $model->load() и вызываем метод login - $model->login()
//        метод login - авторизует пользователя
//        проверяем, если данные пользователя загружены и метод login вернул true
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            редиректим туда, откуда пришел пользователь
            return $this->goBack();
        }

        $model->pass = '';

        //$menu_login = 'active';
//        В противном случае генерируется вид login и передаётся в него модель
        return $this->render('login', [
            'model' => $model,
            //compact('menu_login'),
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        // создаётся модель формы
        $model = new ContactForm();
        
        $this->menu_contact_active = 'active';
        
        // загрузка полученных данных в модель формы
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            // инициализация одноразового флеш сообщения об успешной загрузке
            // пишется в сессию с помощью setFlash(ключ, само сообщение) 
            // и после вывода удаляется (в данном сучае - только ключ, а в виде - организовано само сообщение)
            Yii::$app->session->setFlash('contactFormSubmitted');

            // перезапрашиваем страницу (чтобы по F5 не предлагалось переотправить страницу)
            // в случае ошибки - так не делать, чтобы не терять уже введённые данные из формы (заново их не вводить)
            return $this->refresh();
        }
        // если данные из формы не были загружены - подключаем вид contact
        // и передаём объект модели в вид
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->menu_about_active = 'active';
        
        $page_content = Site::find()
                ->where(['id' => 5])
                ->limit(1)
                ->asArray()
                ->one();
        if( empty($page_content) ) {
            throw new \yii\web\HttpException(404, 'Такой статьи нет');
        }
        //debug($page_content['title']);
        // тег title страницы 
        $this->view->title = $page_content['title'];
        // задаем метатеги
        $this->view->registerMetaTag(
            ['name' => 'keywords', 'content' => $page_content['meta_keywords']]
        );
        $this->view->registerMetaTag(
            ['name' => 'description', 'content' => $page_content['meta_description']]
        );
        return $this->render('about', compact( 'page_content' ));
    }
}
