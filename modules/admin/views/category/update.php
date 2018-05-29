<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCat */

$this->title = 'Редактирование категории "' . $model->title .'"';
$this->params['breadcrumbs'][] = ['label' => 'Управление категориями статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="article-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
