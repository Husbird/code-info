<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = 'Разделы статей / ' . $this->title;
// Виджет хлебные крошки:
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['article/article-main']];
//$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($hfuCategoryTitle), 'url' => ['category/view', 'id' => $article->articleCategory['id']]];
$this->params['breadcrumbs'][] = Yii::$app->formatter->asHtml($this->title);
?>

<div class="row"> <!-- row 1 begins -->
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div style="text-align: center;">
        <h1><?= $category->title?></h1>
    </div>
<?php
//debug($parts); $value['title']
$i = 0;
foreach ($articles as $value):
// замена пробелов в названии (для ЧПУ)
//$hfuArticleTitle = str_replace ( ' ' , '_' , $value['title'] );
$urlTitle = clearUrlStr($value['title']);
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <h2 style="font-size: 16px; font-weight: bold;"><?= $value['title'] ?></h2>
    <a href="<?= yii\helpers\Url::to(['article/view',
        'title' => $urlTitle,
        'id' => $value['id'],
        ]) ?>">
        <?= Html::img( '@web/upload/global/article/' . $value['id'] . '/000.jpg', [ 
        'alt' => $value['title'],
        'class' => 'img-responsive img-rounded'
        ] )?>
    </a>
    <!--<p><small style="margin-left: 60%">от: <?php //echo ($value['date_add']) ? date("m.d.Y", $value['date_add']) : 'не установлено' ;?></small></p>-->
<!--<p><?php // echo substr($value['description'], 0, 400); ?></p>-->
    <p><?= $value['description'] ?></p>
    <p><a href="<?= yii\helpers\Url::to(['article/view',
        'title' => $urlTitle,
        'id' => $value['id'],
        ]) ?>">Читать... &raquo;</a></p>
</div>
        
<?php 
//debug($i);
if ($i === 3 || $i === 6 || $i === 9 || $i === 12) {
    echo '<div class="clearfix"></div>';
}
?>
        
<?php endforeach; ?>
        
<div class="clearfix"></div>

<?php
    if (!$articles) { 
        echo "<h2>Нет статей...</h2>";
    } else {
        echo yii\widgets\LinkPager::widget([
           'pagination' => $pages, 
        ]);
    }
    //debug($articles);
?>

<!--<a href="<?= yii\helpers\Url::to([
        'category/view', 
        'title' => clearUrlStr($category['title']),
        'id' => $category['id'],
            ]) ?>" 
       style="text-transform: uppercase; color: #838080; text-decoration: none; ">
        <?= $category['title']; ?>
        <?php if( isset($category['childs']) ):?>
            <span  style="font-weight: bold; float: right; margin-right: 10px;">+</span>
        <?php endif; ?>
    </a>-->
    </div>
</div> <!-- /row 1 -->