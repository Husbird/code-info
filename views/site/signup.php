<h1>Регистрация</h1>
<?php

use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
/* 
 * Registration page
 */

$this->title = 'Страница регистрации';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('checkMailError')): //если получено флеш сообщение об ошибке:?>

<div class="alert alert-warning">
    Ошибка обработки данных, повторите попытку через минуту.
</div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('checkMailSended')): //если получено флеш сообщение об успехе:?>

<div class="alert alert-success">
    Ваши данные успешно сохранены. На указанный Вами e-mail отправлено письмо с дальнейшими указаниями.
</div>
<?php else: // если флеш сообщение не получено, то выводим содержимое ниже?>

<div class="row">
    <div class="col-lg-5">
<?php
$form = ActiveForm::begin(['class'=>'form-horisontal']);
?>

<?= $form->field($model,'name')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model,'email')->textInput() ?>

<?= $form->field($model,'pass')->passwordInput() ?>

<?= $form->field($model,'pass_repeat')->passwordInput() ?>

<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
]) ?>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Отправить</button>
</div>
<?php
ActiveForm::end();
?>
    </div>
</div>
<?php endif; ?>