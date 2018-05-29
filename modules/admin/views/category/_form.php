<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii;
use app\models\ArticleCat;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleCat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-cat-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
    <?php //echo $form->field($model, 'parent')->dropDownList( yii\helpers\ArrayHelper::map( ArticleCat::find()->all(), 'id', 'title' ) ); ?>
    
    <div class="form-group field-articlecat-parent required has-success">
    <label class="control-label" for="articlecat-parent">Родительская категория</label>
    <select id="articlecat-parent" class="form-control" name="ArticleCat[parent]" aria-required="true" aria-invalid="false">
        <option value="0">Самостоятельная категория (родительские отсутствуют)</option>
        <?= app\components\MenuMsWidget::widget(['tpl' => 'select', 'model' => $model]) ?>
        
    </select>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'date_add')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'access_level')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
