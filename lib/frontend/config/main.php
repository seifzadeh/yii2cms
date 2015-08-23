<?php
$params = array_merge(
	require (__DIR__ . '/../../common/config/params.php'),
	require (__DIR__ . '/../../common/config/params-local.php'),
	require (__DIR__ . '/params.php'),
	require (__DIR__ . '/params-local.php')
);

return [
	'id' => 'app-frontend',
	'basePath' => dirname(__DIR__),
	'bootstrap' => ['log'],
	'controllerNamespace' => 'frontend\controllers',
	'components' => [
		'user' => [
			'identityClass' => 'common\models\User',
			'enableAutoLogin' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'urlManager' => [
			'class' => 'common\component\ZurlManager',
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				'<language:\w+>/<controller>/<action>/<id:\d+>/<title>' => '<controller>/<action>',
				'<language:\w+>/<controller>/<id:\d+>/<title>' => '<controller>/index',
				'<language:\w+>/<controller>/<action>/<id:\d+>' => '<controller>/<action>',
				'<language:\w+>/<controller>/<action>' => '<controller>/<action>',
				'<language:\w+>/<controller>' => '<controller>',
				'<language:\w+>/' => 'site',
				'<language:\w+>/<action>' => 'site/<action>',

				// '' => 'site/index',
				// '<action>' => 'site/<action>',
			],
		],

	],
	'params' => $params,
];
