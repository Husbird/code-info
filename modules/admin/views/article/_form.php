<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// CKEditor
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

//use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */

//Эти поля убраны из формы:
//$form->field($model, 'id')->textInput()
//$form->field($model, 'date_edit')->textInput(['maxlength' => true])
//$form->field($model, 'date_add')->textInput(['maxlength' => true])
//$form->field($model, 'edit_info')->textInput(['maxlength' => true])
//$form->field($model, 'views')->textInput()

//$form->field($model, 'category_id')->textInput()
//$x = 5;
//$z = 10;
//$a = 'Category 1';
//$b = 'Category 2';
//debug($categoryArray);

?>

<div class="article-form">

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
        
//        CKEDITOR.config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
//        CKEDITOR.config.protectedSource.push(/<(style)[^>]*>.*</style>/ig);
//        CKEDITOR.config.protectedSource.push(/<(script)[^>]*>.*</script>/ig);// разрешить теги <script>
        // CKEDITOR.config.protectedSource.push(/<||||||||||?[sS]*??||||||||||зрешить php-код
//        CKEDITOR.config.protectedSource.push(/<!--dev-->[sS]*<!--/dev-->/g);
//        CKEDITOR.config.allowedContent = true; /* all tags */
        , \yii\web\View::POS_LOAD);
//        );
    ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //echo $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    
    <?php
    // Вариант без загрузки картинок:
//    echo $form->field($model, 'text')->widget(CKEditor::className(),[
//        'editorOptions' => [
//            //'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
//            'inline' => false, //по умолчанию false
////            'enterMode' => 'CKEDITOR.ENTER_BR',
////            'clientOptions' => [
////                'enterMode' => 'CKEDITOR.ENTER_BR',
////            ],
//        ],
//    ]);
    

// Вариант с загрузкой картинок:
    echo $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
            // Some CKEditor Options 
//            'preset' => 'full',
//            'clientOptions' => [
//                'enterMode' => 'CKEDITOR.ENTER_BR',
//            ],
            
            
            
//            'enterMode' => 'CKEDITOR.ENTER_BR',
//            config.FillEmptyBlocks = false;
//            config.FormatOutput = false;
//            'preset' => 'basic',
//            'preset' => 'standard',
            ]),
        
    ]);
    
    
//    vova07 редактор
//    echo $form->field($model, 'text')->widget(Widget::className(), [
//    'settings' => [
//        'lang' => 'ru',
//        'minHeight' => 200,
//        'plugins' => [
//            'clips',
//            'fullscreen',
//        ],
//    ],
//]);
    
    ?>
    
    
    
    <?= $form->field($model, 'author_source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($categoryList) ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'access_level')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
