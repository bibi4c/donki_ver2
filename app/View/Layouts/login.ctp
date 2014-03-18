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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--[if lt IE 9]>
        <?php echo $this->Html->script(array('html5.js')); ?>
         <![endif]-->
        <?php echo $this->Html->charset(); ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo '監査報告書データ管理：' . $title_for_layout;
        ?>
        </title>
            <?php
            echo $this->Html->meta('icon');
            echo $this->Html->script('jquery-1.9.1.min');
            echo $this->Html->script(array('common', 'bootstrap'));
            echo $this->Html->css(array('style', 'reset'));

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
            ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="main">
                    <h1><?php
        if ($title_for_layout == 'Errors')
            echo 'ERROR'; else {
            echo "ログイン";
        }
            ?></h1>
                </div>
            </div>

            <div id="container">
                <div class="mainarea">

                    <?php echo $this->Session->flash('auth'); ?>
                    <?php
                    echo $this->Session->flash();
                    echo $this->fetch('content');
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
