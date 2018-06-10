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

<div class="row"> <!-- row main begins -->
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
            <ul class="vert_menu" style="list-style-type:none; border: 1px solid #f6f6f6; padding-left: 5px;">
                <?= \app\components\MenuMsWidget::widget(['tpl' => 'vert_menu']); ?>
            </ul>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="row"> <!-- row 1 -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><!-- контент (средний блок)-->
            <div itemscope itemtype="http://schema.org/TechArticle"> <!-- микроразметка start -->
                <h1 id="h1" itemprop="name" style="text-align: center;"><?php echo $article->title; ?></h1> <!-- Название статьи (имеет приоритет перед name для Яндекса) -->
                <meta itemprop='headline' content='<?php echo $article->title; ?>'> <!-- Название статьи -->
                <meta itemprop="description" content="<?php echo $article->description;?>"> <!-- Краткое описание статьи -->
                <meta itemscope itemprop='mainEntityOfPage' itemType='https://schema.org/WebPage' itemid='<?php echo $micro['mainEntityOfPageUrl'];?>'/>
                <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization"><!-- Издатель start -->
                    <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                        <img itemprop="url image" src="<?php echo $micro['logoImgUrl'];?>" style="display:none;"/>
                        <meta itemprop="width" content="150">
                        <meta itemprop="height" content="150">
                    </div>
                    <meta itemprop="name" content="<?php echo 'Code-info';?>">
                    <meta itemprop="telephone" content="<?php echo '+375295049673';?>">
                    <meta itemprop="address" content="<?php echo 'Республика Беларусь, Витебск';?>">
                </div><!-- Издатель end -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <!-- article block start -->
                    <figure>
                    <img itemprop="image" src="https://code-info.ru/web/upload/global/article/<?php echo $article->id;?>/000.jpg" style="display:none;" alt="<?php echo $article->description;?>" style="max-width: 30%; border-radius: 6px;" />
                    </figure>
                    <p class="text-justify" itemprop="articleBody"> <!-- Краткое описание статьи (имеет приоритет перед description для Яндекса) -->
                        <article>
                            <p class='article_text'>
                                <big><?php echo $article->text;?></big>
                            </p>
                            <div style="float:right;"><div id="vk_like"></div></div>
                            <div id="vk_poll"></div>
                        </article>
                    </p>
                    <div style="display:none"> <!-- hidden microcode start -->
                        <img itemprop="image" src="https://code-info.ru/assets/media/images/article/<?php echo $article->id;?>/000.jpg" />
                        <p itemprop="genre">Техническая</p> <!-- Жанр (множественное) -->
                        <p itemprop="author"><?php echo $article->author_source;?></p> <!-- Автор (краткое) -->

                        <meta itemprop="datePublished" content="<?php echo $micro['datePublished'];?>"> <!-- datePublished -->
                        <meta itemprop="dateModified" content="<?php echo $micro['dateModified'];?>"> <!-- dateModified -->
                    </div> <!-- hidden microcode end -->
                </div><!-- article block end -->
            </div><!-- микроразметка end -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style=""> <!-- text -->
                <div class="small text-muted">
                    <hr>
                    <p class="text-right">Добавлено: <?php echo date(DATE_ISO8601, $article->date_add);;?></p>
                    <p class="text-right">[Просмотров: <?php echo $article->views ?>]</p>
                    <p class="text-right"><a href="<?php echo $article->source_link;?>" target="_blank">Источник: <?php echo $article->author_source;?></a></p>
                    <hr>
                </div>
            </div><!--.text -->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="vk_comments" style="margin: 0 auto; margin-top: 1%;"></div>
                </div>

            </div><!--.контент (средний блок) END-->

        </div> <!-- /row 1 -->
    </div>
</div><!-- row main end -->
