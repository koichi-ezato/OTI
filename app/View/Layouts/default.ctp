<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>OSC Technical Information</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css(array('jquery.mobile.flatui.min','common'));
		echo $this->Html->script(array('jquery-2.1.1.min'));
		echo $this->Html->scriptStart();
		echo "$(document).bind('mobileinit', function(){
				$.mobile.ajaxEnabled = false;
				$.mobile.pushStateEnabled = false;
			});";

		echo $this->Html->scriptEnd();
		echo $this->Html->script(array('jquery.mobile-1.4.2.min','jquery.common'));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
		$app_mode = FALSE;
		$user_agent = env('HTTP_USER_AGENT');
		if(preg_match("/iPhone/", $user_agent)
		|| preg_match("/iPad/", $user_agent)){
			$app_mode = TRUE;
		}
		if($app_mode){
			echo $this->Html->meta(array('name' => 'apple-mobile-web-app-capable','content' => 'yes'));
			echo $this->Html->meta('favicon.ico','/favicon.ico',array('type' => 'icon','rel' => 'apple-touch-icon'));
			echo $this->Html->meta(array('name' => 'viewport','content' => 'width = device-width,initial-scale = 1.0,maximum-scale=1.0,user-scalable = no'));
		}
	?>
</head>
<body>
	<div id="container" data-role="page">
		<div id="header" data-role="header" data-position="fixed">
			<?php if ($this->view != 'login'): ?>
				<?php echo $this->Html->link(__('ログアウト'),array('controller' => 'Users','action' => 'login'),array('data-iconpos' => 'notext','data-role' => 'button','data-icon' => 'power','data-theme' => 'd')); ?>
			<?php endif; ?>
			<h1>OSC Technical Information</h1>
			<?php if ($this->view != 'login' && $this->name != 'Menu'): ?>
				<?php echo $this->Html->link(__('メニュー'),array('controller' => 'Menu','action' => 'index'),array('data-iconpos' => 'notext','data-role' => 'button','data-icon' => 'flat-menu','data-theme' => 'f')); ?>
			<?php endif; ?>
		</div>
		<div id="content" data-role="content" role="main">

			<?php
				if(CakeSession::check('Message.flash')){
					echo $this->Html->scriptStart();
					echo "$(function(){
						$('#message').popup('open');
					});";
					echo $this->Html->scriptEnd();
					echo $this->Html->div('ui-content',null,array('data-role' => 'popup','id' => 'message','data-theme' => 'd','style' => 'max-width: 300px;'));
					echo $this->Html->link('閉じる','#',array('data-rel' => 'back','class' => 'ui-btn ui-corner-all ui-shadow ui-btn-d ui-icon-delete ui-btn-icon-notext ui-btn-right'));
					echo $this->Session->flash();
					echo $this->Html->tag('/div');
				}
			?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer" data-role="footer" data-position="fixed">
			<h1>Copyright © Okinawa Software Center, INC. All rights reserved.</h1>
		</div>
	</div>
</body>
</html>
