<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$aryUser = $this->Session->read('Auth.User');
if (isset($aryUser)) {
    $user_id = $aryUser['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

<?php echo $this->Html->charset(); ?>
        <!--[if lt IE 9]>
        <?php echo $this->Html->script(array('html5.js')); ?>
         <![endif]-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo '監査報告書データ管理：' . $page_tittle; ?>
        </title>
        <script>
            var webroot = '<?php echo $this->App->webroot('/'); ?>';
            var auth_number = <?php echo $aryUser['authority_id']; ?>;
        </script>

<?php
$textcolor = array('blue', 'red', 'blue', 'blue', 'blue');
$text = array('未実施', '監査完了', '承認待ち', '是正中', '実施中');
$icon = array('img/tron2.png', 'img/tron2.png', 'img/tron2.png', 'img/tron2.png', 'img/tron1.png');
$link = array('#link1', '#link2', '#link2', '#link2', '#link4');
echo $this->Html->meta('icon');
echo $this->Html->css(array('reset', 'style'));
echo $this->Html->css('jquery-ui');
echo $this->Html->css('fullcalendar');
echo $this->Html->script('jquery-1.8.3');
echo $this->Html->script('jquery.1.7.2.min');
echo $this->Html->script('jquery-ui');
echo $this->Html->script('fullcalendar');

echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="main">
                    <h1><?php echo $page_tittle ?></h1>
                </div>
            </div>

            <div id="container">
                <div class="toparea clearfix">
                    <div class="link">
<?php
echo $this->Html->link('ホーム', array('controller' => 'menu', 'action' => 'index'), array('escape' => false, 'class' => 'smHome')
);
?>
                        <?php
                        echo $this->Html->link('ログアウト', array('controller' => 'login', 'action' => 'logout'), array('escape' => false, 'class' => 'smLogout')
                        );
                        ?>
                    </div>
                </div>

                <div class="mainarea">	
                        <?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Session->flash(); ?>
<?php echo $this->fetch('content');
?>

                </div>
            </div>
        </div>
    </body>
</html>