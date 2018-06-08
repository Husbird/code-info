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
    <?php
    //echo $page_content['title'];
    ?>
</div>
<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-4">
        <h2>Web Design</h2>
        <img src="/images/templatemo_image_01.jpg" alt="Image 1" class="img-responsive img-rounded img_left" />
        <p>Simplex theme is based on Bootstrap version 3.0.0 and it can be used for any purpose. This is free HTML5 website template by templatemo. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>.</p>

        <h4>Quisque varius adipiscing</h4>
        <p>Suspendisse pretium tincidunt orci, sit amet blandit leo pretium in. Pellentesque viverra vulputate turpis, ut vehicula purus mattis eu.</p>

        <h4>Aliquam erat volutpat</h4>
        <p>Vivamus adipiscing suscipit nisl, et sagittis neque euismod nec. Quisque suscipit neque ac feugiat consequat.</p>
    </div>
      
    <div class="col-md-4">
        <h2>Web Design</h2>
        <img src="/images/templatemo_image_01.jpg" alt="Image 1" class="img-responsive img-rounded img_left" />
        <p>Simplex theme is based on Bootstrap version 3.0.0 and it can be used for any purpose. This is free HTML5 website template by templatemo. Validate <a href="http://validator.w3.org/check?uri=referer" rel="nofollow">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" rel="nofollow">CSS</a>.</p>

        <h4>Quisque varius adipiscing</h4>
        <p>Suspendisse pretium tincidunt orci, sit amet blandit leo pretium in. Pellentesque viverra vulputate turpis, ut vehicula purus mattis eu.</p>

        <h4>Aliquam erat volutpat</h4>
        <p>Vivamus adipiscing suscipit nisl, et sagittis neque euismod nec. Quisque suscipit neque ac feugiat consequat.</p>
    </div>

    <div class="col-md-4">
        <h2>Digital Media</h2>
        <img src="/images/templatemo_image_02.jpg" alt="Image 2" class="img-responsive img-rounded img_left" />
        <p>Pellentesque adipiscing pharetra lorem, ullamcorper luctus tortor iaculis sit amet. In arcu magna, tincidunt at justo eget, mattis semper diam.</p>
        <p>Morbi eu metus accumsan, posuere velit ac, tempor eros. Sed porta in nibh id auctor. Cras scelerisque tempor enim, in condimentum dolor sollicitudin ut.</p>
        <ul>
            <li>Phasellus sit amet lacinia quam</li>
            <li>Duis semper diam mauris, ac porta</li>
            <li>Mauris vitae elementum tellus</li>
            <li>Vestibulum eu pellentesque sem</li>
            <li>Praesent congue nisl ut turpis sagittis</li>
        </ul>
        <p><a class="btn btn-primary" href="#">More Info. &raquo;</a></p>
   </div>

    <div class="col-md-3">
        <h2>Online Marketing</h2>
        <img src="/images/templatemo_image_03.jpg" alt="Image 3" class="img-responsive img-rounded img_left" />
        <p>Praesent ultrices purus a commodo porttitor. Praesent commodo rutrum mattis. Integer pulvinar dui sed pharetra elementum. Ut dapibus faucibus orci, eu interdum magna porttitor et.</p>
        <h4>Donec eu auctor nulla</h4>
        <p>Aliquam sem sapien, hendrerit eget nisi quis, fermentum varius erat. Maecenas ultrices libero libero, a adipiscing risus luctus ut.</p>
        <p>Curabitur dictum nec nisl et faucibus. Quisque rutrum sem blandit convallis malesuada. Quisque blandit consectetur ante, id viverra risus.</p>
        <p><a class="btn btn-success" href="#">Details &raquo;</a></p>
    </div>
        
</div>  /row 1 
      
<div class="row space30">  row 2 begins  
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-4">
        <h2>Sed non arcu blandit</h2>
        <p>Donec auctor aliquet suscipit. Fusce euismod sem neque, eu fermentum libero pretium a. Praesent vel condimentum augue. Vivamus tempor metus sed mollis scelerisque. <a href="#">More Info.</a></p>
    </div>

    <div class="col-md-4">
        <h2>Aliquam non egestas leo</h2>
        <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam tempor, elit sit amet iaculis sodales, orci tellus fringilla nibh, fringilla malesuada ligula sapien quis odio. <a href="#">More Info.</a></p>
    </div>

    <div class="col-md-4">
        <h2>Sed non arcu blandit</h2>
        <p>Quisque tincidunt turpis eleifend, facilisis quam vitae, rhoncus nunc. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed at erat vitae lacus bibendum malesuada quis quis neque. <a href="#">More Info.</a></p>
    </div>

</div>  /row 2 -->
