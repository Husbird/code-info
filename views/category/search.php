<?php
use yii\helpers\Html;

// Виджет хлебные крошки:
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['article-main']];
//$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($hfuCategoryTitle), 'url' => ['category/view', 'id' => $article->articleCategory['id']]];
$this->params['breadcrumbs'][] = Yii::$app->formatter->asHtml("Поиск по запросу: " . $q);
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
    </div>
    
    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        
    <div style="text-align: center;">
        <h2>Поиск по запросу: "<?=$q?>"</h2>
    </div>
<?php if( !empty($articles) ):?>
<?php
//debug($parts); $value['title']
$i = 0;
foreach ($articles as $value):
// замена пробелов в названии (для ЧПУ)
$hfuArticleTitle = str_replace( ' ' , '_' , $value['title'] );
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <h2 style="font-size: 16px; font-weight: bold;"><?= $value['title'] ?></h2>
    
    <a href="<?= yii\helpers\Url::to(['article/view',
        'title' => $hfuArticleTitle,
        'id' => $value['id'],
        ]) ?>">
    <?=Html::img( '@web/upload/global/article/' . $value['id'] . '/000.jpg', [ 
        'alt' => $value['title'],
        'class' => 'img-responsive img-rounded img_left'
        ] ) ?>
    </a>
        
    <p><small style="margin-left: 60%">от: <?= date("m.d.Y", $value['date_add']);?></small></p>
    <p><?= $value['description']; ?></p>
    <p><a href="<?= yii\helpers\Url::to(['article/view',
        'title' => $hfuArticleTitle,
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
<!--<div class="clearfix"></div>-->
<?= yii\widgets\LinkPager::widget(['pagination' => $pages,]);?>
<?php //endif;?>
<?php else:?>
<div style="text-align: center; max-width: 60%; margin-left: 20%;">
    <div class="alert alert-warning">
        <a href="#" class="btn btn-xs btn-warning pull-right">Вернуться на передидущую страницу</a>
        <strong>Поиск:</strong> К сожалению, поиск по ключу <strong>"<?= $q?>"</strong> - не дал результатов...
    </div>
</div>
<?php endif;?>
    </div>
</div> <!-- /row 1 -->

