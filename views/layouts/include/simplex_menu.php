<?php

/*
 * Simplex menu.
 */

use yii\helpers\Html;
?>

<ul class="nav nav-justified">
            <li class="<?php echo $this->context->menu_main_active; ?>"><a href="<?= \yii\helpers\Url::home()?>">Главная</a> <?php // echo Html::a( 'Главная', '/' )?>
            <!--<li><a href="products.html">Products</a></li>-->
            <li class="<?php echo $this->context->menu_article_active; ?>"><?=Html::a( 'Статьи', ['article/article-main'] )?></li>
            <li class="<?php echo $this->context->menu_contact_active; ?>"><?=Html::a( 'Контакты', ['site/contact'] )?></li>
            <!--<li class="<?php //echo $this->context->menu_about_active; ?>"><?php //echo Html::a( 'О проекте', ['site/about'] )?></li>-->
            
            <?php 
            if (Yii::$app->user->isGuest) {
                echo '<li>' . Html::a( 'Регистрация', ['/site/signup'] ) . '</li>';
                echo '<li>' . Html::a( 'Вход', ['/site/login'] ) . '</li>';
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
        </ul>