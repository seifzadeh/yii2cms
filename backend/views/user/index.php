<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">Home</a></li>
    <li role="presentation"><a href="#role" aria-controls="role" role="tab" data-toggle="tab">Role</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="user">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?=GridView::widget([
'dataProvider' => $dataProviderUser,
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'id',
'username',
// 'auth_key',
// 'password_hash',
// 'password_reset_token',
'email:email',
'authAssignment.item_name',
// 'status',
// 'created_at',
// 'updated_at',

['class' => 'yii\grid\ActionColumn'],
],
]);?>

    </div>
    <div role="tabpanel" class="tab-pane" id="role">
    <p>
        <?=Html::a(Yii::t('app', 'Create Role'), ['role/create'], ['class' => 'btn btn-success'])?>
    </p>
            <?=GridView::widget([
'dataProvider' => $dataProviderRole,

'columns' => [
['class' => 'yii\grid\SerialColumn'],

'name',
'description',
[
'class' => 'yii\grid\ActionColumn',
'controller' => 'role',
],

],

]);?>
    </div>

  </div>

</div>





</div>
