<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Управление категориями статей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-cat-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'parent',
                'value' => function($data) {
                    //debug($data);die;
                return isset($data->category->title) ? $data->category->title . ' (id:' .$data->category->id . ')' : 
                        'самостоятельная категория';
                }
            ],
            'description:ntext',
            'keywords',
//            'parent',
//            [
//                'attribute' => 'parent',
//                'value' => function($data) {
//                return $data->category->title ? $data->category->title . ' (id:' .$data->category->id . ')' : 
//                        'самостоятельная категория';
//                }
//            ],
            
            
            //'date_add',
            //'views',
            //'access_level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
