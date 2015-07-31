<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'username')->textInput(['maxlength' => true])?>
    <?=$form->field($model, 'password')->textInput(['maxlength' => true])?>


    <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'status')->checkBox()?>

<div class="form-group field-user-email required">
<label class="control-label" for="auth_item">Role</label>
    <?=Html::activeDropDownList($model, 'auth_item',
ArrayHelper::map(\backend\models\Role::findAll(['type' => 1]), 'name', 'name'), ['class' => 'form-control'])?>
<div class="help-block"></div>
</div>



    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
