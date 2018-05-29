<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контент основных страниц сайта';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить страницу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'meta_description:ntext',
            'meta_keywords',
            'text:ntext',
            //'date_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
