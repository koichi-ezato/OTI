<?php echo $this->Html->script(array('jquery.master.common')); ?>
<div class="ui-grid-d">
	<div class="ui-block-a"></div>
	<div class="ui-block-b" style="width: 60%;">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-g"><h3><?php echo __('業種情報登録'); ?></h3></div>
			<div class="ui-body ui-body-g">
				<?php echo $this->Form->create('BusinessCategory', array('type' => 'post')); ?>
					<?php echo $this->Form->input('name', array('label' => __('名称'), 'div' => array('class' => 'ui-field-contain'))); ?>
					<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
					<?php echo $this->Html->link(__('戻る'), array('controller' => 'BusinessCategories', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
					<?php echo $this->Html->tag('button', __('登録'), array('id' => 'add', 'name' => 'add', 'class' => array('ui-btn', 'ui-btn-a', 'ui-btn-icon-left', 'ui-icon-flat-new', 'ui-mini', 'ui-btn-inline', 'ui-corner-all', 'ui-btn-b'))); ?>
					<?php echo $this->Html->tag('/div'); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
