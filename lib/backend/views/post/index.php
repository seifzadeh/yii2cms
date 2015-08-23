<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?=Html::encode($this->title)?></h1>

<?php if (Yii::$app->user->can('add_post')): ?>
      <p>
        <?=Html::a(Yii::t('app', 'Create Post'), ['create'], ['class' => 'btn btn-success'])?>
    </p>
<?php endif;?>



    <?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [
['class' => 'yii\grid\SerialColumn'],

'id',
'title',
'content:ntext',
'tags:ntext',
'status',
// 'create_time:datetime',
// 'update_time:datetime',
// 'author_id',

[
'class' => 'yii\grid\ActionColumn',
'template' => '{update}   {view}   {delete}',
'buttons' => [

'update' => function ($url, $model) {
if (Yii::$app->user->can('edit_post')) {
return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
'title' => Yii::t('app', 'Info'),
]);
}
},

'delete' => function ($url, $model) {
if (Yii::$app->user->can('delete_post')) {
return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
'title' => Yii::t('app', 'Delete'),
'data-method' => 'post',
'data-confirm' => "Are you sure you want to delete this item?",
]);
}
},

],
// 'buttons' => [
// [
// 'update' => function ($url, $model, $key) {
// //return $model->status === 'editable' ? Html::a('Update', $url) : '';
// },
// ],
// ],
],
],
]);?>

</div>
