<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Post */

$this->title = Yii::t('app', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

<?php if (Yii::$app->user->can('add_post')): ?>
    <h1><?=Html::encode($this->title)?></h1>
<?php endif;?>
    <?=$this->render('_form', [
'model' => $model,
])?>

</div>
