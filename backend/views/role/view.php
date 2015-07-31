<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Role */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-view">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->name], [
'class' => 'btn btn-danger',
'data' => [
'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
'method' => 'post',
],
])?>
    </p>

    <?=DetailView::widget([
'model' => $model,
'attributes' => [
'name',
// 'type',
'description:ntext',
// 'rule_name',
// 'data:ntext',
// 'created_at',
// 'updated_at',
],
])?>

</div>

<!-- <span class="label label-default">Default</span>
<span class="label label-primary">Primary</span>
<span class="label label-success">Success</span>
<span class="label label-info">Info</span>
<span class="label label-warning">Warning</span>
<span class="label label-danger">Danger</span> -->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Roles</h3>
  </div>
  <div class="panel-body">
  <?php
$lbl = ['default', 'primary', 'success', 'info'];
$roles = \backend\models\AuthItemChild::findAll(['parent' => $model->name]);
// print_r($roles);
// exit();
foreach ($roles as $k => $v) {
	$rn = rand(0, 3);
	// echo $v;
	// echo $v['child'];
	echo "<span style=\"margin:5px\" class=\"label label-{$lbl[$rn]}\">{$v['child']}</span>";
}
?>
  </div>
</div>
