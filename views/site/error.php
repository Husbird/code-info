<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <p>
            <?= nl2br(Html::encode($message)) ?>
        </p>
        <p>
            <a href="<?= \yii\helpers\Url::home()?>">Вернуться на главную страницу сайта...</a>
        </p>
    </div>
    
    <p><?=Html::img( '@web/images/main/404.jpeg', [ 
                'alt' => 'Ошибка 404',
                'class' => 'img-responsive img-rounded article_img',
                ] ) ?>
    </p>
    <?php debug($exception);?>
    <p>
        Пожалуйста, свяжитесь с нами, если вы считаете что это ошибка сервера. Спасибо.
    </p>

</div>
