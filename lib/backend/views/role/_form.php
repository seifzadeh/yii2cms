<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Role */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.panel-body label{
    margin-left: 17px;
}

</style>

<div class="row">
    <div class="col-md-4">
        <div class="role-form">
            <?php $form = ActiveForm::begin();?>
            <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
            <?=$form->field($model, 'description')->textarea(['rows' => 6])?>
            <div class="form-group">
                <?=Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
            </div>
        </div>
    </div>
    <div class="col-md-8">
<?php

foreach ($model->getAllRoles() as $k => $v): ?>
	<div class="col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading"><?=Yii::t('app', $k)?></div>
          <div class="panel-body">
                <?php
foreach ($v as $item) {
	echo Html::checkbox("Items[{$item['name']}]", $item['checked'], ['label' => Yii::t('app', $item['label']), 'name' => ["Role[{$item['name']}]"]]);
}

?>
          </div>
        </div>
</div>
<?php endforeach;?>
</div>
<?php ActiveForm::end();?>
</div>
