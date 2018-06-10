<?php
/* @var $this yii\web\View */

//$this->title = 'My Yii Application';

//debug($test);
//debug(Yii::$app->user->identity); //данные о авторизованом пользователе

use yii\helpers\Html;

//$this->title = $this->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    /*
    Пример подключения скрипта "на месте"
    $this->registerJsFile('@web/js/simplex/html5shiv.js');
    Если нужно подключить например перед библиотекой jQuery, то:
    $this->registerJsFile('@web/js/simplex/html5shiv.js',
        ['depends' => 'yii\web\YiiAsset']
        ('depends' - указываются зависимости)
    );

    Если нужно загрузить какой-то js код (после полной загрузки страницы) то:
    $this->registerJs("$('.bible').append('<p>SHOW!!!</p>');", \yii\web\View::POS_LOAD);
        если неважно когда именно загрузить, то второй параметр убираем

    также, можно передать js код в переменной, присвоив его так:
    (пример аякс запроса:)
        $js = <<<JS
            $('#btn').on('click', function() {
                $.ajax({
                    url: 'index.php?r=post/index',
                    data: {test: '123'},
                    type: 'POST',
                    success: function(res) {
                        console.log(res);
                    },
                    error: function() {
                        alert('Error!!!');
                    }    
                });
            });
JS;
    $this->registerJs($js, \yii\web\View::POS_LOAD);
    */

    /*
    Подключение CSS кода:
    $this->registerCss('.bible(background: #ccc;)');
    */

?>
<?php //$this->beginBlock('block1'); // передаём данные из вида в шаблон ?>
<!--    <h1>Заголовок главной страницы (из вьюхи)</h1>-->
<?php //$this->endBlock(); ?>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0px 10px 0px 10px;" >
<!--    <h1><?= Html::encode($this->title) ?></h1>-->
    
    <?php if (Yii::$app->session->hasFlash('userSuccessRegistred')):?>
    <div class="alert alert-success">
        <strong>Проздравляем!</strong> <br>
        Вы успешно зарегистрированы!
    </div>
    <?php endif; ?>
    
    <?php if (Yii::$app->session->hasFlash('userErrorRegistred')):?>
    <div class="alert alert-danger">
        <strong>Ошибка!</strong> <br>
        К сожалению, регистрация завершилась неудачей =(!
    </div>
    <?php endif; ?>
    
    <?= $page_content['text'] ?>
</div>

<div class="test_ms">

</div>