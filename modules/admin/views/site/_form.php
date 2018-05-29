<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\models\Site */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="site-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php
    $this->registerJs(
        "CKEDITOR.editorConfig = function (config) { "
        . "config.language = 'ru' ; "
        . "config.enterMode = CKEDITOR.ENTER_BR;"
        . "config.shiftEnterMode = CKEDITOR.ENTER_P;"
        . "config.allowedContent = true;"
        . "config.protectedSource.push(/<i[^>]*><\/i>/g);"
        . "config.uiColor = '#AADC6E' ; "
        . "};"
        
        , \yii\web\View::POS_LOAD);
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?php
    // Вариант с загрузкой картинок:
    echo $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[/* Some CKEditor Options */]),
    ]);
    ?>

    <?= $form->field($model, 'date_add')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
