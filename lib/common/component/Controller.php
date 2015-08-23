<?php

namespace common\component;
use Yii;

class Controller extends \yii\web\Controller {
	public function init() {

		if (isset($_GET['language'])) {
			// echo $_GET['language'];
			Yii::$app->language = $_GET['language'];
			Yii::$app->session->set('language', $_GET['language']);

			$cookie = new \yii\web\Cookie([
				'name' => 'language',
				'value' => $_GET['language'],
			]);
			$cookie->expire = time() + (60 * 60 * 24 * 365);
			Yii::$app->response->cookies->add($cookie);
		} else if (Yii::$app->session->has('language')) {
			Yii::$app->language = Yii::$app->session->get('language');
		} else if (Yii::$app->request->cookies['language']) {
			Yii::$app->language = Yii::$app->request->cookies['language']->value;
		} else {
			Yii::$app->language = 'fa';
		}
		parent::init();
	}
}

?>