<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArticleCat */

$this->title = 'Добавление новой категории';
$this->params['breadcrumbs'][] = ['label' => 'Управление категориями статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-cat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
