<div class="ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-a"><h3><?php echo __('技術情報照会'); ?></h3></div>
	<div class="ui-body ui-body-a">
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('タイトル'),array('style' => 'width: 20%;')); ?>
			<?php echo $this->Html->tag('label',$record['TechnicalInformation']['title'],array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('業種'),array('style' => 'width: 20%;')); ?>
			<?php $tmp = array(); ?>
			<?php if (is_array($record['TechnicalInformation']['business_categories'])): ?>
			<?php foreach ($record['TechnicalInformation']['business_categories'] as $val): ?>
				<?php if (isset($business_categories[$val])): ?>
					<?php $tmp[] = $business_categories[$val]; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php echo $this->Html->tag('label',implode(' , ', $tmp),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('DB'),array('style' => 'width: 20%;')); ?>
			<?php $tmp = array(); ?>
			<?php if (is_array($record['TechnicalInformation']['databases'])): ?>
			<?php foreach ($record['TechnicalInformation']['databases'] as $val): ?>
				<?php if (isset($databases[$val])): ?>
					<?php $tmp[] = $databases[$val]; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php echo $this->Html->tag('label',implode(' , ', $tmp),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('フレームワーク'),array('style' => 'width: 20%;')); ?>
			<?php $tmp = array(); ?>
			<?php if (is_array($record['TechnicalInformation']['frameworks'])): ?>
			<?php foreach ($record['TechnicalInformation']['frameworks'] as $val): ?>
				<?php if (isset($frameworks[$val])): ?>
					<?php $tmp[] = $frameworks[$val]; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php echo $this->Html->tag('label',implode(' , ', $tmp),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('OS'),array('style' => 'width: 20%;')); ?>
			<?php $tmp = array(); ?>
			<?php if (is_array($record['TechnicalInformation']['operating_systems'])): ?>
			<?php foreach ($record['TechnicalInformation']['operating_systems'] as $val): ?>
				<?php if (isset($operating_systems[$val])): ?>
					<?php $tmp[] = $operating_systems[$val]; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php echo $this->Html->tag('label',implode(' , ', $tmp),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('プログラム言語'),array('style' => 'width: 20%;')); ?>
			<?php $tmp = array(); ?>
			<?php if (is_array($record['TechnicalInformation']['programming_languages'])): ?>
			<?php foreach ($record['TechnicalInformation']['programming_languages'] as $val): ?>
				<?php if (isset($programming_languages[$val])): ?>
					<?php $tmp[] = $programming_languages[$val]; ?>
				<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php echo $this->Html->tag('label',implode(' , ', $tmp),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('詳細'),array('style' => 'width: 20%;')); ?>
			<?php echo $this->Html->tag('label', nl2br($record['TechnicalInformation']['detail']),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('Evernote URL'),array('style' => 'width: 20%;')); ?>
			<?php echo $this->Html->tag('label', $this->Html->link($record['TechnicalInformation']['url_evernote'], $record['TechnicalInformation']['url_evernote'], array('target' => '_blank')),array('style' => 'width: 75%;')); ?>
		</div>
		<div class="ui-field-contain">
			<?php echo $this->Html->tag('label',__('GitHub URL'),array('style' => 'width: 20%;')); ?>
			<?php echo $this->Html->tag('label', $this->Html->link($record['TechnicalInformation']['url_github'], $record['TechnicalInformation']['url_github'], array('target' => '_blank')),array('style' => 'width: 75%;')); ?>
		</div>
		<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
			<?php echo $this->Html->link(__('戻る'), array('controller' => 'TechnicalInformations', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
			<?php echo $this->Html->link(__('編集'), array('controller' => 'TechnicalInformations', 'action' => 'edit', $record['TechnicalInformation']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-eye', 'ui-btn-icon-left', 'ui-btn-b'))); ?>
		<?php echo $this->Html->tag('/div'); ?>
	</div>
</div>
