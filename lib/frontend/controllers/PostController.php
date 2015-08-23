<?php

namespace frontend\controllers;

use common\component\Controller;
use Yii;

/**
 *
 */
class PostController extends Controller {

	public function actionShow($title) {
		$post = \frontend\models\Post::findOne(['title' => $title]);
		return $this->render('/site/show_post', ['model' => $post]);
	}

	public function actionAdd_comment() {
		$model = new \frontend\models\Comment;
		$model->create_time = time();
		if ($model->load(Yii::$app->request->post()) && $model->save()) {

			echo 'Youre Comment Saved';

		} else {
			echo 'fail';
		}
	}
}

?>