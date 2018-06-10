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
    
    // Анимация текста в хедере
    $header_anim_title = <<<JS
        let spans = document.querySelectorAll('.word span');
        spans.forEach((span, idx) => {
	span.addEventListener('click', (e) => {
            e.target.classList.add('active');
	});
	span.addEventListener('animationend', (e) => {
            e.target.classList.remove('active');
	});
	
	// Initial animation
	setTimeout(() => {
            span.classList.add('active');
	}, 750 * (idx+1))
});
JS;
$this->registerJs($header_anim_title, \yii\web\View::POS_LOAD);    
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    
    <?php $this->head() ?>
  </head>

  <body>
    <?php $this->beginBody() ?>
    <div id="container" class="container">
        
        <header class="header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <!--<span class="header_title">Code-info.ru</span>-->
                    <div class="word header_title">
                        <span>C</span>
                        <span>O</span>
                        <span>D</span>
                        <span>E</span>
                        <span>-</span>
                        <span>I</span>
                        <span>N</span>
                        <span>F</span>
                        <span>O</span>
                        <span>.</span>
                        <span>R</span>
                        <span>U</span>
                    </div>
<!--                    <span style="margin-left:70%;">Просто о сложном...</span>-->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    
                </div>
                <div class="col-lg-3 col-md-3 hidden-sm hidden-xs" style="padding-top:2%;">
                    <div id="custom-search-input">
                        <div class="input-group" style="">
                            <form method="GET" action="<?= \yii\helpers\Url::to(['category/search']); ?>" class="navbar-form navbar-search" role="search">
                                <div class="input-group-btn">
                                    <input type="text" class="search-query form-control" name="q" required="" placeholder="Найти..." />
                                    <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <!--        <img src="/images/header_code_info2.jpg" class="img-responsive" style="width:100%; height: 220px;" />-->
    <!--        <a href="#"><img src="/images/templatemo_header.jpg" alt="Simplex Responsive Template" class="img-responsive" /></a>-->
            
        </header>
        
        <div class="clearfix"></div>
        
        <?php
            include_once 'include/main_menu.php';
            //include 'include/simplex_menu.php';
        ?>
 
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
