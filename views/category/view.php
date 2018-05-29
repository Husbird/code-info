<?php
use yii\helpers\Html;

//$this->params['breadcrumbs'][] = 'Разделы статей / ' . $this->title;
// Виджет хлебные крошки:
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['article/article-main']];
//$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($hfuCategoryTitle), 'url' => ['category/view', 'id' => $article->articleCategory['id']]];
$this->params['breadcrumbs'][] = Yii::$app->formatter->asHtml($this->title);
?>

<div class="row space30"> <!-- row 1 begins -->
    <div style="text-align: center;">
        <h1><?= $category->title?></h1>
    </div>
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
<!--        <form class="navbar-form navbar-search" role="search">
            <div class="input-group">
                <input type="text" class="form-control">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-search btn-info">
                        <span class="glyphicon glyphicon-search"></span>
                        <span class="label-icon">Search</span>
                    </button>
                </div>
            </div>  
        </form>-->
    </div>
<?php
//debug($parts); $value['title']
foreach ($articles as $value):
// замена пробелов в названии (для ЧПУ)
//$hfuArticleTitle = str_replace ( ' ' , '_' , $value['title'] );
$urlTitle = clearUrlStr($value['title']);
?>
<div class="col-md-3">
    <h2 style="font-size: 16px; font-weight: bold;"><?= $value['title'] ?></h2>
    <?php echo Html::img( '@web/upload/global/article/' . $value['id'] . '/000.jpg', [ 
        'alt' => $value['title'],
        'class' => 'img-responsive img-rounded img_left'
        ] )?>
    <p><small style="margin-left: 60%">от: <?= ($value['date_add']) ? date("m.d.Y", $value['date_add']) : 'не установлено' ;?></small></p>
<!--    <p><?php // echo substr($value['description'], 0, 400); ?></p>-->
    <p><?= $value['description'] ?></p>
    <p><a class="btn btn-primary" href="<?= yii\helpers\Url::to(['article/view',
        'title' => $urlTitle,
        'id' => $value['id'],
        ]) ?>">Читать... &raquo;</a></p>
</div>
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
</div> <!-- /row 1 -->

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