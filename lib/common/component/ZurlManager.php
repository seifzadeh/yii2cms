<?php
namespace common\component;

use Yii;
use yii\web\UrlManager;

class ZurlManager extends urlManager {

	public function createUrl($params) {
		// echo 'createUrl by ZurlManager';
		if (!isset($params['language'])) {
			if (Yii::$app->session->has('language')) {
				Yii::$app->language = Yii::$app->session->get('language');
			} else if (Yii::$app->request->cookies['language']) {
				Yii::$app->language = Yii::$app->request->cookies['language']->value;
			}

		}

		$params['language'] = Yii::$app->language;

		return parent::createUrl($params);
	}

}

?>