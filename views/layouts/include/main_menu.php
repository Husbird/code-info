<?php
use yii\helpers\Html;
?>
<!--навигация nav-justified href="#home" data-toggle="tab"-->
<nav class="navbar navbar-default" role="navigation nav-stacked" style="">
<!--    <span style="display:block; ">code-info.ru</span>-->
        <div class="container-fluid">
            <!--Название компании и кнопка, которая отображается для мобильных устройств группируются для лучшего отображения при свертывание-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= \yii\helpers\Url::home()?>">Menu</a> <!--логотип-->
            </div>
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="<?php echo $this->context->menu_main_active; ?>"><a href="<?= \yii\helpers\Url::home()?>">Главная</a> <?php // echo Html::a( 'Главная', '/' )?>
                    <!--<li><a href="products.html">Products</a></li>-->
                    <li class="<?php echo $this->context->menu_article_active; ?>"><?=Html::a( 'Статьи', ['article/article-main'],['class' => 'nav_bar_a_ms'] )?></li>
                    <li class="<?php echo $this->context->menu_contact_active; ?>"><?=Html::a( 'Контакты', ['site/contact'] )?></li>
                    
<!--                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Статьи<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Пункт 1</a></li>
                        <li><a href="#">Пункт 2</a></li>
                        <li><a href="#">Пункт 3</a></li>
                    
                        <li class="divider"></li>
                        <li><a href="#">Все статьи</a></li>
                    
                    </ul>
                    </li>-->
                    
                    <?php 
                    if (Yii::$app->user->isGuest) {
                        echo '<li class="'.$this->context->menu_signup_active.'">' . Html::a( 'Регистрация', ['/site/signup'] ) . '</li>';
                        echo '<li class="'.$this->context->menu_login_active.'">' . Html::a( 'Вход', ['/site/login'] ) . '</li>';
                    } elseif (!Yii::$app->user->isGuest && Yii::$app->user->identity->adm_mss >= 2) {
                        echo '<li>' . Html::a( 'Админка' , ['/admin'] ) . '</li>';
                        echo '<li>' . Html::a( 'Выход (' . Yii::$app->user->identity->name . ')' , ['/site/logout'] )  . '</li>';
                    } else {
                        echo '<li>' . Html::a( 'Выход (' . Yii::$app->user->identity->name . ')' , ['/site/logout'] )  . '</li>';
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

                    
                    <!--<form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default" title="данная функция в стадии разработки...">поиск</button>
                    </form>-->
                    
                </ul>
            </div>
        </div>
    </nav>
    <!--навигация end-->