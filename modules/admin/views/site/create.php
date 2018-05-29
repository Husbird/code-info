<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Site */

$this->title = 'Добавление новой страницы';
$this->params['breadcrumbs'][] = ['label' => 'Контент основных страниц сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
