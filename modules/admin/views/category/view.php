<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCat */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Управление категориями статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-cat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить категорию "' . $model->title . '"?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'keywords',
//            'parent',
            [
                'attribute' => 'parent',
                'value' => $model->category->title  ? $model->category->title . ' (id:' .$model->category->id . ')' : 
                        'самостоятельная категория',
            ],
            'date_add',
            'views',
            'access_level',
        ],
    ]) ?>

</div>
