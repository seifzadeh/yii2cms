<div class="blog-post">
  <h class="blog-post-title"><a href="<?=\yii\helpers\Url::to(['post/show', 'title' => $model->title])?>" title="<?=$model->title?>"><?=$model->title?></a></h4>
  <p class="blog-post-meta"><?=\Yii::$app->formatter->asDate($model->create_time, 'long')?> <a href="#"><?=$model->author->username?></a></p>
 <p><?=mb_substr($model->content, 0, 300)?></p>
</div><!-- /.blog-post -->