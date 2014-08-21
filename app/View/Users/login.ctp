<div class="ui-grid-d">
	<div class="ui-block-a"></div>
	<div class="ui-block-b" style="width: 60%;">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a"><h3><?php echo __('ログイン'); ?></h3></div>
			<div class="ui-body ui-body-a">
				<?php echo $this->Form->create('User', array('type' => 'post')); ?>
					<?php echo $this->Form->input('username', array('placeholder' => __('ログインID'),'label' => false,'div' => false)); ?>
					<?php echo $this->Form->input('password', array('placeholder' => __('パスワード'),'label' => false,'div' => false)); ?>
					<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
					<?php echo $this->Html->tag('button', __('ログイン'), array('id' => 'login','name' => 'login','class' => array('ui-btn','ui-btn-a','ui-btn-icon-left','ui-icon-lock','ui-mini','ui-btn-inline','ui-corner-all'))); ?>
					<?php echo $this->Html->tag('/div'); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
