<?php
use backend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage()?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <?=Html::csrfMetaTags()?>
    <?=$this->head()?>
    <title><?=$this->title?></title>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php

NavBar::begin([
	'brandLabel' => 'NavBar Test',

	'options' =>
	['class' => 'navbar navbar-inverse navbar-fixed-top'],
]);

if (Yii::$app->user->can('admin_post')) {
	$items[] = ['label' => '<span class="glyphicon glyphicon-pencil   "></span> Post', 'url' => ['/post/index']];
}
if (Yii::$app->user->can('admin_comment')) {
	$items[] = ['label' => '<span class="glyphicon glyphicon-comment"></span> Comment', 'url' => ['/comment/index']];
}

if (Yii::$app->user->can('admin_ctegory')) {
	$items[] = ['label' => '<span class="glyphicon glyphicon-tasks"></span> Category', 'url' => ['/category/index']];
}

if (Yii::$app->user->can('admin_user')) {
	$items[] = ['label' => '<span class="glyphicon glyphicon-user"></span> Users', 'url' => ['/user/index']];
}

$items[] = [
	'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
	'url' => ['/site/logout'],
	'linkOptions' => ['data-method' => 'post'],
];

echo Nav::widget([
	'items' => $items,
	'encodeLabels' => false,
	'options' => ['class' => 'nav navbar-nav side-nav'],
]);
NavBar::end();

?>
        </nav>

        <div id="page-wrapper">

        <?=$content?>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
  <?=$this->endBody()?>

</body>

</html>
<?=$this->endPage()?>
