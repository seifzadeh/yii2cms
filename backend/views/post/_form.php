<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-8">
        <div class="post-form">

            <?php $form = ActiveForm::begin();?>

            <?=$form->field($model, 'title')->textInput(['maxlength' => true])?>

            <?=$form->field($model, 'content')->textarea(['rows' => 6])?>

            <?=$form->field($model, 'tags')->textarea(['rows' => 6])?>

            <?=$form->field($model, 'status')->textInput()?>

            <?=$form->field($model, 'create_time')->textInput()?>

            <?=$form->field($model, 'update_time')->textInput()?>

            <?=$form->field($model, 'author_id')->textInput()?>

            <div class="form-group">
                <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
            </div>


    </div>
    </div>
    <div class="col-md-4">

    <?php
echo yii\helpers\Html::checkBoxList('PostCategory', $model->getSelectedCategory(), $model->getAllCategorys());

?>

    </div>
 <?php ActiveForm::end();?>

</div>
