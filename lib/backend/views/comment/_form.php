<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Comment */
/* @var $form yii\widgets\ActiveForm */
?>

<div>
<?=$model->post->title;?>
</div>
<div class="comment-form">

    <?php $form = ActiveForm::begin();?>

    <?=$form->field($model, 'content')->textarea(['rows' => 6])?>

    <?=$form->field($model, 'status')->checkBox()?>

    <?=$form->field($model, 'create_time')->textInput()?>

    <?=$form->field($model, 'author')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'email')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'url')->textInput(['maxlength' => true])?>


    <div class="form-group">
        <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
