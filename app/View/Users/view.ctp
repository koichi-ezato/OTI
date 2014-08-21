<div class="ui-grid-d">
	<div class="ui-block-a"></div>
	<div class="ui-block-b" style="width: 60%;">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-g"><h3><?php echo __('ユーザ照会'); ?></h3></div>
			<div class="ui-body ui-body-g">
				<div class="ui-field-contain">
					<?php echo $this->Html->tag('label',__('社員番号'),array('style' => 'width: 30%;')); ?>
					<?php echo $this->Html->tag('label',$record['User']['username'],array('style' => 'width: 30%;')); ?>
				</div>
				<div class="ui-field-contain">
					<?php echo $this->Html->tag('label',__('氏名'),array('style' => 'width: 30%;')); ?>
					<?php echo $this->Html->tag('label',$record['User']['name'],array('style' => 'width: 30%;')); ?>
				</div>
				<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
					<?php echo $this->Html->link(__('戻る'), array('controller' => 'Users', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
					<?php echo $this->Html->link(__('編集'), array('controller' => 'Users', 'action' => 'edit', $record['User']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-eye', 'ui-btn-icon-left', 'ui-btn-b'))); ?>
				<?php echo $this->Html->tag('/div'); ?>
			</div>
		</div>
	</div>
</div>
