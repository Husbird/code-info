<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Site */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Контент основных страниц сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить страницу "' . $this->title . '" ???',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'meta_description:ntext',
            'meta_keywords',
            'text:html',
            'date_add',
        ],
    ]) ?>

</div>
