<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О проекте';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    
    <div class="row space30" style="padding: 0px 10px 0px 10px; "> <!-- row 1 begins -->
    <?= $page_content['text'] ?>
    <?php
    //echo $page_content['title'];
    ?>
    </div>

<!--    <code><?= __FILE__ ?></code>-->
</div>
