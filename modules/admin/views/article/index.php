<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
//debug($category);die;
$this->title = 'Редактирование статей';
$this->params['breadcrumbs'][] = $this->title;
//$this->category = $category;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить новую статью', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'title',
            [
                'attribute' => 'title',
                'format' => 'html',
            ],
            
            //'description:ntext',
            //'text:ntext',
            [
                'attribute' => 'date_add',
                'value' => function($data) {
                    if ($data->date_add) {
                        return date("m.d.Y", $data->date_add);
                    }
                }
            ],
//            'date_add',
            //'date_edit',
            //'edit_info',
            //'author_source',
            //'source_link',
                    
//            'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->articleCategory['title'] . " (id:" . $data->category_id . ")";
                }
            ],
                    
            //'keywords',
            'views',
            //'access_level',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
