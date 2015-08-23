<?php
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
             <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-signin']]);?>
                <span id="reauth-email" class="reauth-email"></span>
                 <?=$form->field($model, 'username')?>
                <?=$form->field($model, 'password')->passwordInput()?>
                <?=$form->field($model, 'verifyCode')->widget(Captcha::className());?>
                <?=$form->field($model, 'rememberMe')->checkbox()?>
                <div class="form-group">
                    <?=Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])?>
                </div>
             <?php ActiveForm::end();?>
        </div>
    </div>




