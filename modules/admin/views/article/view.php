<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */


$this->title = Yii::$app->formatter->asHtml($model->title);
$this->params['breadcrumbs'][] = ['label' => 'Редактирование статей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">

    <h1>Просмотр статьи №<?= Html::encode($model->id) ?></h1>
    <span class="small"><?= $this->title?></span>
    <hr>
    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить статью "' . $model->title . '"?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'title',
            [
                'attribute' => 'title',
                'format' => 'html',
            ],
            'description:ntext',
            //'text:ntext',
            'text:html',
            //'date_add',
            [
                'attribute' => 'date_add',
                'value' => function($data) {
                    if ($data->date_add) {
                        return date("m.d.Y", $data->date_add);
                    }
                }
            ],
            //'date_edit',
            [
                'attribute' => 'date_edit',
                'value' => function($data) {
                    if ($data->date_edit) {
                        return date("m.d.Y", $data->date_edit);
                    }
                }
            ],
            //'edit_info',
            'author_source',
            'source_link',
            //'category_id',
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category_id . " (" . $data->articleCategory['title'] . ")";
                }
            ],
            'keywords',
            'views',
            'access_level',
        ],
    ]) ?>

</div>
