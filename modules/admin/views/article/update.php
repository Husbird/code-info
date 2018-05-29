<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Редактирование статьи №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Редактирование статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

//debug($categoryArray);
use app\models\Article_cat;





//$categoryArray = Article_cat::find()->asArray()->all();
//
////    Получаем массив-дерево конечных категорий (у которых нет Child-дов)
//    $mainCategoriesTree = getMainCategoriesTree($categoryArray);
////    Получаем массив с id конечных категорий и строкой - описанием их иерархии
//    $categoryList = getCategoryList($mainCategoriesTree);
//    debug($categoryList);
//die;




//$this->registerJs(
//        "CKEDITOR.editorConfig = function (config) { "
//        . "config.language = 'ru' ; "
//        . "config.enterMode = CKEDITOR.ENTER_BR;"
//        . "config.shiftEnterMode = CKEDITOR.ENTER_P;"
//        . "config.allowedContent = true;"
//        . "config.protectedSource.push(/<i[^>]*><\/i>/g);"
//        . "config.uiColor = '#AADC6E' ; "
//        . "};"
//        
////        CKEDITOR.config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
////        CKEDITOR.config.protectedSource.push(/<(style)[^>]*>.*</style>/ig);
////        CKEDITOR.config.protectedSource.push(/<(script)[^>]*>.*</script>/ig);// разрешить теги <script>
//        // CKEDITOR.config.protectedSource.push(/<||||||||||?[sS]*??||||||||||зрешить php-код
////        CKEDITOR.config.protectedSource.push(/<!--dev-->[sS]*<!--/dev-->/g);
////        CKEDITOR.config.allowedContent = true; /* all tags */
//        //, \yii\web\View::POS_LOAD);
//        );
?>

<!--CKEDITOR.editorConfig = function (  config ) { config.language = 'fr' ; config.uiColor = '#AADC6E' ; };-->
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <!--Подключаем форму и передаём в неё модель (массив данных)-->
    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
    ]) ?>

</div>
