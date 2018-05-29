<?php
use yii\helpers\Html;

// Виджет хлебные крошки:
$this->params['breadcrumbs'][] = ['label' => 'Разделы статей', 'url' => ['article-main']];
//$this->params['breadcrumbs'][] = ['label' => Yii::$app->formatter->asHtml($hfuCategoryTitle), 'url' => ['category/view', 'id' => $article->articleCategory['id']]];
$this->params['breadcrumbs'][] = Yii::$app->formatter->asHtml("Поиск по запросу: " . $q);
?>
<div class="row space30"> <!-- row 1 begins -->
    <div style="text-align: center;">
        <h2>Поиск по запросу: "<?=$q?>"</h2>
    </div>
    <?php if( !empty($articles) ):?>
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
    </div>
<?php
//debug($parts); $value['title']
foreach ($articles as $value):
// замена пробелов в названии (для ЧПУ)
$hfuArticleTitle = str_replace ( ' ' , '_' , $value['title'] );
?>
<div class="col-md-3">
    <h2 style="font-size: 16px; font-weight: bold;"><?= $value['title'] ?></h2>
    <?=Html::img( '@web/images/article/' . $value['id'] . '/000.jpg', [ 
        'alt' => $value['title'],
        'class' => 'img-responsive img-rounded img_left'
        ] ) ?>
    <p><small style="margin-left: 60%">от: <?= date("m.d.Y", $value['date_add']);?></small></p>
    <p><?= substr($value['text'], 0, 400); ?></p>
    <p><a class="btn btn-primary" href="<?= yii\helpers\Url::to(['article/view',
        'title' => $hfuArticleTitle,
        'id' => $value['id'],
        ]) ?>">Читать... &raquo;</a></p>
</div>
<?php endforeach; ?>
<div class="clearfix"></div>
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

</div> <!-- /row 1 -->

