<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetSimplex;
//use app\assets\AppAssetSimplex_lt;

AppAssetSimplex::register($this);
//AppAssetSimplex_lt::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() // спец токен для отправки POST запросов (защита от атак)?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
//    Пример подключения скрипта в шаблоне по условию:
//        $this->registerJsFile('js/simplex/html5shiv.js',
//           ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
    ?>
    
    <?php
    // кнопка "вверх" <!-- Starting the plugin -->
    $js_to_top_button = <<<JS
        //$(document).ready(function() {
        /*
         var defaults = {
         containerID: 'toTop', // fading element id
         containerHoverID: 'toTopHover', // fading element hover id
         scrollSpeed: 1200,
         easingType: 'linear'
         };
         */
        $().UItoTop({ easingType: 'easeOutQuart' });
       //});
JS;
    $this->registerJs($js_to_top_button, \yii\web\View::POS_LOAD); 
    //<!--UItoTop jQuery Plugin 1.2 END-->
    ?>
    
    <?php $this->head() ?>
  </head>

  <body>
    <?php $this->beginBody() ?>
    <div id="container" class="container">
        <div style="width:100%; height: 200px;  background-image: url(/images/header_code_info2.jpg);">
            <span class="header_title">Code-info.ru</span>
<!--        <img src="/images/header_code_info2.jpg" class="img-responsive" style="width:100%; height: 220px;" />-->
<!--        <a href="#"><img src="/images/templatemo_header.jpg" alt="Simplex Responsive Template" class="img-responsive" /></a>-->
        </div>
        <ul class="nav nav-justified">
            <li class="<?php echo $this->context->menu_main_active; ?>"><a href="<?= \yii\helpers\Url::home()?>">Главная</a> <?php // echo Html::a( 'Главная', '/' )?>
            <!--<li><a href="products.html">Products</a></li>-->
            <li class="<?php echo $this->context->menu_article_active; ?>"><?=Html::a( 'Статьи', ['article/article-main'] )?></li>
            <li class="<?php echo $this->context->menu_contact_active; ?>"><?=Html::a( 'Контакты', ['site/contact'] )?></li>
            <!--<li class="<?php //echo $this->context->menu_about_active; ?>"><?php //echo Html::a( 'О проекте', ['site/about'] )?></li>-->
            
            <?php 
            if (Yii::$app->user->isGuest) {
                echo '<li>' . Html::a( 'Вход', ['/site/login'] ) . '</li>';
            } else {
                echo '<li>' . Html::a( 'Админка' , ['/admin'] ) . '</li>';
                echo '<li>' . Html::a( 'Выход (' . Yii::$app->user->identity->email . ')' , ['/site/logout'] )  . '</li>';
//                echo '<li>'
//                . Html::beginForm(['/site/logout'], 'post')
//                . Html::submitButton(
//                    'Logout (' . Yii::$app->user->identity->email . ')'//,
//                    //['class' => 'btn btn-link logout']
//                )
//                . Html::endForm()
//                . '</li>';
            }
            ?>
        </ul>
        <hr>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>
        <?= $content ?>

      <!-- Site footer -->
      <div class="clearfix"></div>
      <div class="footer">
        <p class="pull-left">&copy; <?= Yii::$app->name.' '.date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
      </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
