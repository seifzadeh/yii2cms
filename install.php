<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>install yii2 cms</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/install.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#">Yii2 CMS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <?php
            $select = isset($_GET['s']) ? $_GET['s'] : null;
            $link = [
              ['url' => 'overview', 'label' => 'Overview'],
              ['url' => 'check_requrment', 'label' => 'check_requrment'],
              ['url' => 'db_config', 'label' => 'db_config'],
              ['url' => 'install', 'label' => 'install'],
              ['url' => 'config', 'label' => 'config'],
              ['url' => 'home_cms', 'label' => 'home'],
            ];
            $disabled_button = '';
            $disable = 'onclick="return false" disabled';
            foreach ($link as $k => $v):
            ?>
            <li <?php if ($v['url'] == $select) {
                echo 'class="active"';
              }
              ?>><a href="install.php?s=<?=$v['url']?>"><?=$v['label']?></a></li>
              <?php endforeach;?>
            </ul>
          </div>
          <?php if ($select == 'overview' || $select == null): ?>
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Overview Of Install Yii2 CMS</h1>
            <div class="row placeholders">
              <div class="col-xs-6 col-sm-3 placeholder">
                <h4>Step 1: Check Requrment</h4>
                <span class="text-muted">php 5.4,pdo,gd</span>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder">
                <h4>Step 2: Databse</h4>
                <span class="text-muted">Something else</span>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder">
                <h4>Step 3: Install</h4>
                <span class="text-muted">install of base system</span>
              </div>
              <div class="col-xs-6 col-sm-3 placeholder">
                <h4>Step 4: Use Yii2 CMS</h4>
                <span class="text-muted">success installed</span>
              </div>

              <a href="install.php?s=overview" title="db config" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Previos </a>
        &nbsp;&nbsp;&nbsp;
        <a href="install.php?s=check_requrment" title="db config" class="btn btn-success" <?=$disabled_button;?>><span class="glyphicon glyphicon-arrow-right"> Next </a>
            </div>
          </div>
          <?php endif;?>
          <?php if ($select == 'check_requrment'): ?>
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Check Of Base Requrments</h1>
            <table class="table table-condensed">
              <?php
              function php_version_check() {
                return version_compare(PHP_VERSION, '5.4.0', '>=') ? true : flase;
              }
              function php_gd_check() {
                if (extension_loaded('gd')) {
                  $gdInfo = gd_info();
                  if (empty($gdInfo['FreeType Support'])) {
                    return false;
                  } else {
                    return true;
                  }
                }
              }
              $requirements = array(
                array(
                  'name' => 'PHP 5.4.0',
                  'mandatory' => true,
                  'condition' => php_version_check(),
                  'by' => 'All DB-related classes',
                  'memo' => 'PHP 5.4.0 or higher is required. ',
                ),
                array(
                  'name' => 'GD PHP extension',
                  'mandatory' => true,
                  'condition' => php_gd_check(),
                  'by' => 'All DB-related classes',
                  'memo' => '   Either GD PHP extension with FreeType support or ImageMagick PHP extension with PNG support is required for image CAPTCHA. ',
                ),
                array(
                  'name' => 'PDO extension',
                  'mandatory' => true,
                  'condition' => extension_loaded('pdo'),
                  'by' => 'All DB-related classes',
                  'memo' => 'All DB-related classes ',
                ),
                array(
                  'name' => 'PDO MySQL extension',
                  'mandatory' => false,
                  'condition' => extension_loaded('pdo_mysql'),
                  'by' => 'All DB-related classes',
                  'memo' => 'Required for MySQL database.',
                ),
                array(
                  'name' => 'GD PHP extension with FreeType support',
                  'mandatory' => false,
                  'condition' => 'gdOK',
                  'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
                  'memo' => 'gdMemo',
                ),
                array(
                  'name' => 'ImageMagick PHP extension with PNG support',
                  'mandatory' => false,
                  'condition' => 'imagickOK',
                  'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-captcha-captcha.html">Captcha</a>',
                  'memo' => 'imagickMemo',
                ),
                'phpSmtp' => array(
                  'name' => 'PHP mail SMTP',
                  'mandatory' => false,
                  'condition' => strlen(ini_get('SMTP')) > 0,
                  'by' => 'Email sending',
                  'memo' => 'PHP mail SMTP server required',
                ),
              );
              foreach ($requirements as $k => $v) {
                $row = "<td>{$v['name']}</td><td>{$v['by']}</td><td>{$v['memo']}</td>";
                if ($v['condition'] == true) {
                $row = "<tr class=\"success\">{$row}</tr>";
              } else {
              $row = "<tr class=\"danger\">{$row}</tr>";
              $disabled_button = 'onclick="return false" disabled';
            }
            echo $row;
          }
          ?>
        </table>
        <a href="install.php?s=overview" title="db config" class="btn btn-warning"><span class="glyphicon glyphicon-arrow-left"></span> Previos </a>
        &nbsp;&nbsp;&nbsp;
        <a href="install.php?s=db_config" title="db config" class="btn btn-success" <?=$disabled_button;?>><span class="glyphicon glyphicon-arrow-right"> Next </a>
      </div>
      <?php endif;?>
      <?php if ($select == 'db_config') {
      ?>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php
        $state = isset($_GET['state']) ? $_GET['state'] : null;
          if ($state == 'check_config') {
        ?>
        <?php
        $db_server = isset($_GET['dbserver']) ? $_GET['dbserver'] : null;
            $db_name = isset($_GET['dbname']) ? $_GET['dbname'] : null;
            $db_user = isset($_GET['dbuser']) ? $_GET['dbuser'] : null;
            $db_pass = isset($_GET['dbpass']) ? $_GET['dbpass'] : null;
            if ($db_server && $db_name && $db_user) {
              try {
                $db = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
                if ($db) {
        $config_file = '<?php';
        $config_file .= "\n";
        $config_file .= "define('YII2CMS_DB_SERVER','{$db_server}');\n";
        $config_file .= "define('YII2CMS_DB_NAME','{$db_name}');\n";
        $config_file .= "define('YII2CMS_DB_USER','$db_user');\n";
        $config_file .= "define('YII2CMS_DB_PASS','$db_pass');\n";
        try {
          if (file_put_contents('lib/common/config/db.php', $config_file)) {
            header('Location: install.php?s=install');
          }
        } catch (Exception $e) {
        echo "<textarea><?=$config_file?></textarea>";
        }
        }
        } catch (Exception $e) {
        ?>
        <div class="alert alert-danger" role="alert"><?=$e->getMessage()?></div>
        <?php
        }
            }
        ?>
        <h1>db check config</h1>
        <?php } else {?>
        <form class="form-horizontal" action="install.php" id="frm-db-config" method="get">
          <input type="hidden" value="db_config" name="s">
          <input type="hidden" value="check_config" name="state">
          <div class="form-group">
            <label for="db-server" class="col-sm-2 control-label" >Database Server</label>
            <div class="col-sm-10">
              <input name="dbserver" type="text" class="form-control" id="db-server" placeholder="Database Server" required>
            </div>
          </div>
          <div class="form-group">
            <label for="db-Name" class="col-sm-2 control-label" >Database Name</label>
            <div class="col-sm-10">
              <input name="dbname" type="text" class="form-control" id="db-Name" placeholder="Database Name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="db-username" class="col-sm-2 control-label">Database Username</label>
            <div class="col-sm-10">
              <input name="dbuser" type="text" class="form-control"  id="db-username" placeholder="Database Connection Username" required>
            </div>
          </div>
          <div class="form-group">
            <label for="db-pass" class="col-sm-2 control-label">Database Password</label>
            <div class="col-sm-10">
              <input name="dbpass" type="password" class="form-control"  id="db-pass" placeholder="Database Connection Password">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Check Of Database Config</button>
            </div>
          </div>
        </form>
      </div>
      <?php }
      ?>
      <?php }
      ?>
      <?php if ($select == 'install'): ?>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <?php
        include 'lib/common/config/db.php';
        try {
          $db = new PDO('mysql:host=' . YII2CMS_DB_SERVER . ';dbname=' . YII2CMS_DB_NAME, YII2CMS_DB_USER, YII2CMS_DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
          if ($db) {
            $sql = "CREATE TABLE IF NOT EXISTS `user` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
        `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
        `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `status` smallint(6) NOT NULL DEFAULT '10',
        `created_at` int(11) NOT NULL,
        `updated_at` int(11) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `auth_rule` (
        `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        `data` text COLLATE utf8_unicode_ci,
        `created_at` int(11) DEFAULT NULL,
        `updated_at` int(11) DEFAULT NULL,
        PRIMARY KEY (`name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `auth_item` (
        `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        `type` int(11) NOT NULL,
        `description` text COLLATE utf8_unicode_ci,
        `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
        `data` text COLLATE utf8_unicode_ci,
        `created_at` int(11) DEFAULT NULL,
        `updated_at` int(11) DEFAULT NULL,
        PRIMARY KEY (`name`),
        KEY `rule_name` (`rule_name`),
        KEY `idx-auth_item-type` (`type`),
        CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `auth_item_child` (
        `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        PRIMARY KEY (`parent`,`child`),
        KEY `child` (`child`),
        CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
        CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `auth_assignment` (
        `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        `user_id` int(11) NOT NULL,
        `created_at` int(11) DEFAULT NULL,
        PRIMARY KEY (`item_name`,`user_id`),
        KEY `user_id` (`user_id`),
        CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE CASCADE,
        CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `category` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(300) COLLATE utf8_persian_ci NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `post` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(128) COLLATE utf8_persian_ci NOT NULL,
        `content` text COLLATE utf8_persian_ci NOT NULL,
        `tags` text COLLATE utf8_persian_ci,
        `status` int(11) NOT NULL,
        `create_time` int(11) DEFAULT NULL,
        `update_time` int(11) DEFAULT NULL,
        `author_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `FK_post_author` (`author_id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `comment` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `content` text COLLATE utf8_persian_ci NOT NULL,
        `status` tinyint(1) NOT NULL DEFAULT '0',
        `create_time` int(11) DEFAULT NULL,
        `author` varchar(128) COLLATE utf8_persian_ci NOT NULL,
        `email` varchar(128) COLLATE utf8_persian_ci NOT NULL,
        `url` varchar(128) COLLATE utf8_persian_ci DEFAULT NULL,
        `post_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `FK_comment_post` (`post_id`),
        CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `migration` (
        `version` varchar(180) COLLATE utf8_persian_ci NOT NULL,
        `apply_time` int(11) DEFAULT NULL,
        PRIMARY KEY (`version`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `post_category` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `post_id` int(11) NOT NULL,
        `category_id` int(11) NOT NULL,
        PRIMARY KEY (`id`),
        KEY `post_id` (`post_id`),
        KEY `category_id` (`category_id`),
        CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
        CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE IF NOT EXISTS `tag` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(128) COLLATE utf8_persian_ci NOT NULL,
        `frequency` int(11) DEFAULT '1',
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "CREATE TABLE `config` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `_name` varchar(200) COLLATE utf8_persian_ci NOT NULL,
        `_value` text COLLATE utf8_persian_ci NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `_name` (`_name`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $sql .= "   CREATE TABLE `menu` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(200) COLLATE utf8_persian_ci NOT NULL,
        `url` varchar(500) COLLATE utf8_persian_ci NOT NULL,
        `_order` int(11) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
        ('add_category', 2, 'add_category', NULL, NULL, 1438361915, 1438361915),
        ('add_comment', 2, 'add_comment', NULL, NULL, 1438361915, 1438361915),
        ('add_post', 2, 'add_post', NULL, NULL, 1438361915, 1438361915),
        ('add_user', 2, 'add_user', NULL, NULL, 1438361915, 1438361915),
        ('admin', 1, 'the full access', NULL, NULL, 1438361915, 1438361915),
        ('admin_comment', 2, 'admin_comment', NULL, NULL, 1438361915, 1438361915),
        ('admin_ctegory', 2, 'admin_ctegory', NULL, NULL, 1438361915, 1438361915),
        ('admin_post', 2, 'admin_post', NULL, NULL, 1438361915, 1438361915),
        ('admin_user', 2, 'admin_user', NULL, NULL, 1438361915, 1438361915),
        ('delete_category', 2, 'delete_category', NULL, NULL, 1438362575, 1438362575),
        ('delete_comment', 2, 'delete_comment', NULL, NULL, 1438362575, 1438362575),
        ('delete_post', 2, 'delete_post', NULL, NULL, 1438362575, 1438362575),
        ('delete_user', 2, 'delete_user', NULL, NULL, 1438362575, 1438362575),
        ('edit_category', 2, 'edit_category', NULL, NULL, 1438362575, 1438362575),
        ('edit_commant', 2, 'edit_commant', NULL, NULL, 1438361915, 1438361915),
        ('edit_post', 2, 'edit_post', NULL, NULL, 1438361915, 1438361915),
        ('edit_user', 2, 'edit_user', NULL, NULL, 1438362575, 1438362575);";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
        ('admin', 'add_category'),
        ('admin', 'add_comment'),
        ('admin', 'add_post'),
        ('admin', 'add_user'),
        ('admin', 'admin_comment'),
        ('admin', 'admin_ctegory'),
        ('admin', 'admin_post'),
        ('admin', 'admin_user'),
        ('admin', 'delete_category'),
        ('admin', 'delete_comment'),
        ('admin', 'delete_post'),
        ('admin', 'delete_user'),
        ('admin', 'edit_category'),
        ('admin', 'edit_commant'),
        ('admin', 'edit_post'),
        ('admin', 'edit_user');";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
        ('admin', 32, NULL);";
            $result = $db->exec($sql);
            $sql = "INSERT IGNORE INTO `config` (`id`, `_name`,`_value`) VALUES
        (1, 'about_site', NULL),
        (2, 'category', NULL),
        (3, 'site_name', NULL);";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `category` (`id`, `title`) VALUES
        (1, 'sample');";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `post` (`id`, `title`, `content`, `tags`, `status`, `create_time`, `update_time`, `author_id`) VALUES
        (1, 'پست اول', 'این یک نمونه پست cms می‌باشد.', 'post', 1, 1438354756, 1438738461, 1);";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `post_category` (`id`, `post_id`, `category_id`) VALUES
        (1, 1, 1)";
            $result = $db->exec($sql);
            $sql = "INSERT INTO `menu` (`id`, `title`, `url`, `_order`) VALUES (1, 'صفحه اصلی', 'index.php', 1) ";
            $result = $db->exec($sql);
        ?>
        <div class="alert alert-success" role="alert">Install base system. next for base config of cms/div>
          <a href="install.php?s=db_config" title="db config" class="btn btn-warning" <?=$disable?>><span class="glyphicon glyphicon-arrow-left"></span> Previos </a>
          &nbsp;&nbsp;&nbsp;
          <a href="install.php?s=config" title="db config" class="btn btn-success" ><span class="glyphicon glyphicon-arrow-right"> Next </a>
          <?php
          }
          } catch (Exception $e) {
          ?>
          <div class="alert alert-danger" role="alert"><?=$e->getMessage()?></div>
          <a href="install.php?s=db_config" title="db config" class="btn btn-warning" ><span class="glyphicon glyphicon-arrow-left"></span> Previos </a>
          &nbsp;&nbsp;&nbsp;
          <a href="install.php?s=config" title="db config" class="btn btn-success" <?=$disable?>><span class="glyphicon glyphicon-arrow-right"> Next </a>
          <?php
          }
          ?>
        </div>
        <?php endif;?>
        <?php if ($select == 'config'): ?>
        <?php
        $save_config = isset($_GET['state']) ? $_GET['state'] : null;
        if ($save_config == 'save_config') {
          include 'lib/common/config/db.php';
          function generatePasswordHash($password) {
            $salt = sprintf("$2y$%02d$", 13);
            $salt .= str_replace('+', '.', substr(base64_encode('RvWRKFXJyKcPdHZ0Zj8f'), 0, 22));
            $hash = crypt($password, $salt);
            if (!is_string($hash) || strlen($hash) !== 60) {
              echo 'Unknown error occurred while generating hash.';
            }
            return $hash;
          }
          $site_name = isset($_POST['site_name']) ? $_POST['site_name'] : null;
          $about_site = isset($_POST['about_site']) ? $_POST['about_site'] : null;
          $username = isset($_POST['username']) ? $_POST['username'] : null;
          $password = isset($_POST['password']) ? generatePasswordHash($_POST['password']) : null;
          $email = isset($_POST['email']) ? $_POST['email'] : null;
          try {
            $db = new PDO('mysql:host=' . YII2CMS_DB_SERVER . ';dbname=' . YII2CMS_DB_NAME, YII2CMS_DB_USER, YII2CMS_DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            if ($db) {
              $sql = "UPDATE `config` SET `_value`='$about_site' WHERE `_name`='about_site' ";
              $result = $db->exec($sql);
              $sql = "UPDATE `config` SET `_value`='$site_name' WHERE `_name`='site_name' ";
              $result = $db->exec($sql);
              $t = time();
              $sql = "INSERT INTO `user`(`username`,`auth_key`,`password_hash`,`email`,`created_at`,`updated_at`)VALUES('$username','$2y$13$UnZXUktGWEp5S2NQZEhaM.qbj','$password','$email','$t','$t')";
              $result = $db->exec($sql);
              $sql = "INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES ('admin', '1', '$t');";
              $result = $db->exec($sql);
              header('Location: install.php?s=home_cms');
            }
          } catch (Exception $e) {
          }
        }
        ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <form class="form-horizontal" action="install.php?s=config&state=save_config" id="frm-db-config" method="post">
            <div class="form-group">
              <label for="db-server" class="col-sm-2 control-label" >Administartor Username</label>
              <div class="col-sm-10">
                <input name="username" type="text" class="form-control" id="db-server" placeholder="Administartor Username" required>
              </div>
            </div>
            <div class="form-group">
              <label for="db-Name" class="col-sm-2 control-label" >Administartor Password</label>
              <div class="col-sm-10">
                <input name="password" type="password" class="form-control" id="db-Name" placeholder="Administartor Password" required>
              </div>
            </div>
            <div class="form-group">
              <label for="db-username" class="col-sm-2 control-label">Administartor Email</label>
              <div class="col-sm-10">
                <input name="email" type="email" class="form-control"  id="db-username" placeholder="Administartor Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="db-username" class="col-sm-2 control-label">Site name</label>
              <div class="col-sm-10">
                <input name="site_name" type="text" class="form-control"  id="db-username" placeholder="Site Name" required>
              </div>
            </div>
            <div class="form-group">
              <label for="db-username" class="col-sm-2 control-label">About the site</label>
              <div class="col-sm-10">
                <!-- <input name="dbuser" type="email" class="form-control"  id="db-username" placeholder="Administartor Email" required> -->
                <textarea name="about_site" class="form-control" placeholder="about the site"></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Save Config</button>
              </div>
            </div>
          </form>
        </div>
        <?php endif;?>
        <?php if ($select == 'home_cms'): ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div class="alert alert-success" role="alert">Yii2 CMS Installed. </div>
          <div class="alert alert-danger" role="alert">Delete the <b>install.php</b> from root folder</div>
          &nbsp;&nbsp;&nbsp;
          <a href="index.php" title="db config" class="btn btn-success" <?=$disabled_button;?>><span class="glyphicon glyphicon-arrow-right"> Next To Home Yii2 CMS</a>
        </div>
        <?php endif;?>
      </div>
    </div>
  </body>
</html>