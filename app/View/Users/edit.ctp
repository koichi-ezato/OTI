<?php echo $this->Html->script(array('jquery.master.common')); ?>
<script>
$(function(){
	$(document).on('click', '#delete', function(){
		if (confirm("<?php echo __('削除します。よろしいですか？') ?>")){
			location.href = "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'delete', $record['User']['_id'])); ?>";
			return false;
		}
	});
});
</script>
<div class="ui-grid-d">
	<div class="ui-block-a"></div>
	<div class="ui-block-b" style="width: 60%;">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-g"><h3><?php echo __('ユーザ編集'); ?></h3></div>
			<div class="ui-body ui-body-g">
				<?php echo $this->Form->create('User', array('type' => 'post', 'novalidate' => true)); ?>
					<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $record['User']['_id'])); ?>
					<?php echo $this->Form->input('username', array('value' => $record['User']['username'], 'label' => __('社員番号'), 'div' => array('class' => 'ui-field-contain'))); ?>
					<?php echo $this->Form->input('password', array('label' => __('パスワード'), 'div' => array('class' => 'ui-field-contain'))); ?>
					<?php echo $this->Form->input('name', array('value' => $record['User']['name'], 'label' => __('氏名'), 'div' => array('class' => 'ui-field-contain'))); ?>
					<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
					<?php echo $this->Html->link(__('戻る'), array('controller' => 'Users', 'action' => 'view', $record['User']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
					<?php echo $this->Html->tag('button', __('編集'), array('id' => 'edit', 'name' => 'edit', 'class' => array('ui-btn', 'ui-btn-a', 'ui-btn-icon-left', 'ui-icon-flat-new', 'ui-mini', 'ui-btn-inline', 'ui-corner-all', 'ui-btn-b'))); ?>
					<?php echo $this->Html->link(__('削除'), '#', array('id' => 'delete', 'class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-cross', 'ui-btn-icon-left', 'ui-btn-d'))); ?>
					<?php echo $this->Html->tag('/div'); ?>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</div>
</div>
