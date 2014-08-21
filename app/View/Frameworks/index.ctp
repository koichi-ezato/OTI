<div class="ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-g"><h3><?php echo __('フレームワーク情報一覧'); ?></h3></div>
	<div class="ui-body ui-body-g">
		<?php echo $this->Form->create('Frameworks', array('type' => 'post')); ?>
			<?php echo $this->Form->input('name', array('label' => __('名称'), 'div' => array('class' => 'ui-field-contain'))); ?>
			<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
			<?php echo $this->Html->link(__('戻る'), array('controller' => 'Menu', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
			<?php echo $this->Html->link(__('新規'), array('controller' => 'Frameworks', 'action' => 'add'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-plus', 'ui-btn-icon-left', 'ui-btn-g'))); ?>
			<?php echo $this->Html->tag('button', __('検索'), array('id' => 'search', 'name' => 'search', 'class' => array('ui-btn', 'ui-btn-a', 'ui-btn-icon-left', 'ui-icon-search', 'ui-mini', 'ui-btn-inline', 'ui-corner-all', 'ui-btn-b'))); ?>
			<?php echo $this->Html->tag('/div'); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
<br>
<table class="table-stripe">
	<thead>
		<tr>
			<th><?php echo __('照会'); ?></th>
			<th><?php echo __('名称'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($list)): ?>
		<?php foreach ($list as $value): ?>
		<tr>
			<td style="text-align: center;"><?php echo $this->Html->link(__('照会'), array('controller' => 'Frameworks', 'action' => 'view', $value['Framework']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-eye', 'ui-btn-icon-left', 'ui-btn-b'))); ?></td>
			<td><?php echo $value['Framework']['name']; ?></td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
