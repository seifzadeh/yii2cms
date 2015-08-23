<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$config_db = \frontend\models\Config::find()->all();
$config = [];
foreach ($config_db as $k => $v) {
  $config[$v['_name']]=$v['_value'];
}

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
  <?=$this->beginBody()?>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
         <!--  <a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a> -->
          <?php
          $menus = \frontend\models\Menu::find()->orderBy('_order')->all();
          foreach ($menus as $k => $v) { ?>
            <a class="blog-nav-item" href="<?=$v['url']?>"><?=$v['title']?></a>
          <?php } ?>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title"><?=$config['site_name'] ?></h1>
       <!--  <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

        <?=$content?>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
        <div class="alert alert-info" role="alert">Language <a href="<?php echo Url::base() . '/fa'?>">FA</a> / <a href="<?php echo Url::base() . '/en';?>">EN</a></div>
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p><?=$config['about_site'] ?></p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <?=$this->endBody()?>
  </body>
</html>
<?=$this->endPage()?>
