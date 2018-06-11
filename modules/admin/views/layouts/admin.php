<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetSimplex;
use app\assets\AppAssetSimplex_lt;

AppAssetSimplex::register($this);
AppAssetSimplex_lt::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() // спец токен для отправки POST запросов (защита от атак)?>
    <title>Admin | <?= Html::encode($this->title) ?></title>
    <?php
//    Пример подключения скрипта в шаблоне по условию:
//        $this->registerJsFile('js/simplex/html5shiv.js',
//           ['position' => \yii\web\View::POS_HEAD, 'condition' => 'lte IE9']);
    ?>
    <?php $this->head() ?>
  </head>

  <body>
    <?php $this->beginBody() ?>
    <div id="container" class="container">
<!--        <div style="width:100%; height: 50px;  background-image: url(/images/header_code_info2.jpg);">
            <span class="header_title">Code-info.ru</span>
        </div>-->
        
        <ul class="nav nav-justified">
            <li class=""><a href="<?= \yii\helpers\Url::home()?>">Выход из админки</a> <?php // echo Html::a( 'Главная', '/' )?>
            <!--<li><a href="products.html">Products</a></li>-->
            <li><?=Html::a( 'Статьи', ['/admin/article/index'] )?></li>
            <li><?=Html::a( 'Категории', ['/admin/category/index'] )?></li>
            <li><?=Html::a( 'Основные страницы', ['/admin/site/index'] )?></li>
<!--<li class="<?php //echo $this->context->menu_about_active; ?>"><?php //echo Html::a( 'О проекте', ['site/about'] )?></li>-->
            <li>
            <?php 
            if (Yii::$app->user->isGuest) {
                echo Html::a( 'Вход', ['/site/login'] );
            } else {
                echo Html::a( 'Выход (' . Yii::$app->user->identity->email . ')' , ['/site/logout'] );
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
          </li>
        </ul>
        <hr>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?= Alert::widget() ?>
        
        <?php if( Yii::$app->session->hasFlash('success') ): ?>
        <div class="alert alert-success">
            <strong>Поздравляю!</strong> <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
        <?php endif;?>
        
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
