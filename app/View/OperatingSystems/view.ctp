<div class="ui-grid-d">
	<div class="ui-block-a"></div>
	<div class="ui-block-b" style="width: 60%;">
		<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-g"><h3><?php echo __('OS情報照会'); ?></h3></div>
			<div class="ui-body ui-body-g">
				<div class="ui-field-contain">
					<?php echo $this->Html->tag('label',__('名称'),array('style' => 'width: 30%;')); ?>
					<?php echo $this->Html->tag('label',$record['OperatingSystem']['name'],array('style' => 'width: 30%;')); ?>
				</div>
				<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
					<?php echo $this->Html->link(__('戻る'), array('controller' => 'OperatingSystems', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
					<?php echo $this->Html->link(__('編集'), array('controller' => 'OperatingSystems', 'action' => 'edit', $record['OperatingSystem']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-eye', 'ui-btn-icon-left', 'ui-btn-b'))); ?>
				<?php echo $this->Html->tag('/div'); ?>
			</div>
		</div>
	</div>
</div>
