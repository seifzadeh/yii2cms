<?php
return [
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		// 'urlManager' => [
		// 	'class' => 'common\component\ZurlManager',
		// 	'enablePrettyUrl' => true,
		// 	'showScriptName' => false,
		// 	'rules' => [
		// 		'<language:\w+>/' => 'site/index',
		// 		'<language:\w+>/<action>' => 'site/<action>',
		// 		'<language:\w+>/<controller>/<action>' => '<controller>/<action>',

		// 		// [
		// 		// 	'pattern' => '<language>/<title>',
		// 		// 	'route' => '<language:\w+>/post/show',
		// 		// 	'suffix' => '.html',
		// 		// ],
		// 	],
		// ],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
	],
];
