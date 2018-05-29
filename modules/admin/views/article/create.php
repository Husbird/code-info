<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = 'Добавление новой статьи';
$this->params['breadcrumbs'][] = ['label' => 'Редактирование статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
    ]) ?>

</div>
