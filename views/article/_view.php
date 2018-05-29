<?php
use yii\helpers\Html;

// замена пробелов в названии (для ЧПУ)
//$hfuCategoryTitle = str_replace ( ' ' , '_' , $article->articleCategory['title'] );
$urlTitle = clearUrlStr($article->articleCategory['title']);
// Виджет хлебные крошки:
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['article-main']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($article->articleCategory['title']), 'url' => ['category/view', 
    'title' => $urlTitle,
    'id' => $article->articleCategory['id']]];
$this->params['breadcrumbs'][] = Yii::$app->formatter->asHtml($this->title);
?>

<div class="row space30"> <!-- row 1 begins -->
    <div class="col-md-3">
            <ul class="vert_menu" style="list-style-type:none; border: 1px solid #f6f6f6; padding-left: 5px;">
                <?= \app\components\MenuMsWidget::widget(['tpl' => 'vert_menu']); ?>
            </ul>
            <div id="custom-search-input">
            <div class="input-group col-md-12">
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

<div class="col-md-9">
    <div class="row">
        <div class="col-md-12">
            <h2><?= $article['title'] ?></h2>
            <?php /*echo Html::img( '@web/images/article/' . $article['id'] . '/000.jpg', [ 
                'alt' => $article['title'],
                'class' => 'img-responsive img-rounded img_left article_img',
                ] )*/ ?>
<!--            <p>Описание раздела (description): <?php //echo $article['description'] ?></p>-->
<!--            <p>Ключевые слова (keywords): <?php //echo $article['keywords'] ?></p>-->
        </div>
        <div class="col-md-12">
            <?= $article['text'] ?>

            <p><a href="#">Источник:</a></p>

            <p>Категория: <a href="<?= yii\helpers\Url::to([
                'category/view', 
                'title' => $urlTitle,
                'id' => $article->articleCategory['id'],
                    ]) ?>"><?=$article->articleCategory['title'];?></a></p>
            <?php
                //debug($article);
                //debug($article->articleCategory);
            ?>
        </div>
    </div><!--row-->
</div>
<!--    <div class="col-md-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
         Indicators 
        <ol class="carousel-indicators">
            <?php
//                foreach ($articleForCarusel as $key => $value) {
//                    $class_active = "";
//                    if($key == 0) {
//                        $class_active = "class='active'";    
//                    }
//                    echo "<li data-target='#myCarousel' data-slide-to='$key' $class_active></li>";
//                }
//            ?>
        </ol>

         Wrapper for slides 
        <div class="carousel-inner">
            <?php
//               foreach ($articleForCarusel as $key => $value) {
//                    $class_name = "item";
//                    if($key == 0) {
//                        $class_name = "item active";
//                    }
//                    echo "<div class='$class_name'>";
//                        echo Html::img( '@web/images/article/' . $value['id'] . '/000.jpg', [ 
//                            'alt' => $value['title'],
//                            'class' => 'carousel-img',
//                            ] );
//                        echo "<div class='carousel-caption'>
//                                <h5>{$article->articleCategory['title']}</h5>";
//        // замена пробелов в названии (для ЧПУ)
//        $hfuArticleTitle = str_replace ( ' ' , '_' , $article->articleCategory['title'] ); 
//                               echo " <p><a href='".yii\helpers\Url::to(['article/view',
//        'title' => $hfuArticleTitle,
//        'id' => $value['id'],
//        ])."'>{$value['title']}</a></p>";
//                        echo "</div>";
//                    echo "</div>";
//               }
            ?>
        </div>

         Left and right controls 
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </div>-->
    
</div> <!-- /row 1 -->

