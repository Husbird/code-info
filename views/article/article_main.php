<?php
use yii\helpers\Html;

//$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row"> <!-- row 1 begins -->
    <div id="custom-search-input" class="hidden-lg hidden-md col-sm-12 col-xs-12">
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
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <ul class="vert_menu">
            <?= \app\components\MenuMsWidget::widget(['tpl' => 'vert_menu']); ?>
        </ul>
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
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
    <div style="text-align: center;">
        <h1><?= $article_page['title']?></h1>
    </div>
<?php
//debug($parts); $value['title']
$i = 0;
foreach ($articles as $value):
// замена пробелов в названии (для ЧПУ)
//$hfuArticleTitle = str_replace ( ' ' , '_' , $value['title'] );
$urlTitle = clearUrlStr($value['title']);
$i++;
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <h2 style="font-size: 16px; font-weight: bold;"><?= $value['title'] ?></h2>
    <a href="<?= yii\helpers\Url::to(['article/view',
        'title' => $urlTitle,
        'id' => $value['id'],
        ]) ?>">
        <figure>
        <?= Html::img( '@web/upload/global/article/' . $value['id'] . '/000.jpg', [ 
            'alt' => $value['title'],
            'class' => 'img-responsive img-rounded'
            ] )
        ?>
        </figure>
    </a>
    <!--<p><small style="margin-left: 60%">от: <?php //echo ($value['date_add']) ? date("m.d.Y", $value['date_add']) : 'не установлено' ;?></small></p>-->
<!--    <p><?php // echo substr($value['description'], 0, 400); ?></p>-->
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
    </div>
</div> <!-- /row 1 -->