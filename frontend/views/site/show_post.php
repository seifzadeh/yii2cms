<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>

<div class="blog-post">
  <h class="blog-post-title"><a href="<?=\yii\helpers\Url::to(['post/show', 'title' => $model->title])?>" title="<?=$model->title?>"><?=$model->title?></a></h4>
  <p class="blog-post-meta"><?=\Yii::$app->formatter->asDate($model->create_time, 'long')?> <a href="#"><?=$model->author->username?></a></p>
 <p><?=$model->content?></p>
</div><!-- /.blog-post -->



<div class="panel panel-default">
  <div class="panel-heading">Youre Comment</div>
	<div class="panel-body">
	<?php
$comment = new \frontend\models\Comment;
Pjax::begin(['enablePushState' => false]);
$form = ActiveForm::begin([
	'action' => ['post/add_comment'],
	'enableClientValidation' => false,
	'options' => ['data-pjax' => ''],

]);
echo $form->field($comment, 'author');
echo $form->field($comment, 'email');
echo $form->field($comment, 'url');
echo $form->field($comment, 'content')->textArea();
echo $form->field($comment, 'verifyCode')->widget(Captcha::className());

?>
<input type="hidden" name="Comment[post_id]" value="<?=$model->id?>">

<div class="form-group">
<?=Html::submitButton('Submit', ['class' => 'btn btn-primary'])?>
</div>
<?php ActiveForm::end();?>
<?php Pjax::end();?>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">All comments</h3>
  </div>
  <div class="panel-body">
   all
  </div>
</div>