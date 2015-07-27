<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?=Html::encode($this->title)?></h1>

    <p>
        <?=Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success'])?>
    </p>

    <?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'id',
'username',
// 'password',
// 'salt',
'email:email',
// 'profile:ntext',

['class' => 'yii\grid\ActionColumn'],
],
]);?>

</div>
