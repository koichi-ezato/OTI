<div class="ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-a"><h3><?php echo __('技術情報一覧'); ?></h3></div>
	<div class="ui-body ui-body-a">
		<?php echo $this->Form->create('TechnicalInformations', array('type' => 'post')); ?>
			<?php echo $this->Form->input('title', array('label' => __('タイトル'), 'div' => array('class' => 'ui-field-contain'))); ?>
		<div class="ui-grid-d" style="height: 235px;overflow-y: auto;">
			<div class="ui-block-a ui-group-theme-a ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('business_categories', array('options' => $business_categories, 'label' => __('業種'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-b ui-group-theme-b ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('databases', array('options' => $databases, 'label' => __('DB'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-c ui-group-theme-e ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('frameworks', array('options' => $frameworks, 'label' => __('フレームワーク'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-d ui-group-theme-f ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('operating_systems', array('options' => $operating_systems, 'label' => __('OS'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-e ui-group-theme-g ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('programming_languages', array('options' => $programming_languages, 'label' => __('プログラム言語'), 'multiple' => 'checkbox')); ?>
			</div>
		</div>
		
			<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
			<?php echo $this->Html->link(__('戻る'), array('controller' => 'Menu', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
			<?php echo $this->Html->link(__('クリア'), array('controller' => 'TechnicalInformations', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-refresh', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
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
			<th><?php echo __('タイトル'); ?></th>
			<th><?php echo __('業種'); ?></th>
			<th><?php echo __('DB'); ?></th>
			<th><?php echo __('フレームワーク'); ?></th>
			<th><?php echo __('OS'); ?></th>
			<th><?php echo __('プログラム言語'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (isset($list)): ?>
		<?php foreach ($list as $value): ?>
		<tr>
			<td style="text-align: center;"><?php echo $this->Html->link(__('照会'), array('controller' => 'TechnicalInformations', 'action' => 'view', $value['TechnicalInformation']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-eye', 'ui-btn-icon-left', 'ui-btn-b'))); ?></td>
			<td><?php echo $value['TechnicalInformation']['title']; ?></td>
			<td>
				<?php $tmp = array(); ?>
				<?php if (is_array($value['TechnicalInformation']['business_categories'])): ?>
				<?php foreach ($value['TechnicalInformation']['business_categories'] as $val): ?>
					<?php if (isset($business_categories[$val])): ?>
						<?php $tmp[] = $business_categories[$val]; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php echo implode(' , ', $tmp); ?>
			</td>
			<td>
				<?php $tmp = array(); ?>
				<?php if (is_array($value['TechnicalInformation']['databases'])): ?>
				<?php foreach ($value['TechnicalInformation']['databases'] as $val): ?>
					<?php if (isset($databases[$val])): ?>
						<?php $tmp[] = $databases[$val]; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php echo implode(' , ', $tmp); ?>
			</td>
			<td>
				<?php $tmp = array(); ?>
				<?php if (is_array($value['TechnicalInformation']['frameworks'])): ?>
				<?php foreach ($value['TechnicalInformation']['frameworks'] as $val): ?>
					<?php if (isset($frameworks[$val])): ?>
						<?php $tmp[] = $frameworks[$val]; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php echo implode(' , ', $tmp); ?>
			</td>
			<td>
				<?php $tmp = array(); ?>
				<?php if (is_array($value['TechnicalInformation']['operating_systems'])): ?>
				<?php foreach ($value['TechnicalInformation']['operating_systems'] as $val): ?>
					<?php if (isset($operating_systems[$val])): ?>
						<?php $tmp[] = $operating_systems[$val]; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php echo implode(' , ', $tmp); ?>
			</td>
			<td>
				<?php $tmp = array(); ?>
				<?php if (is_array($value['TechnicalInformation']['programming_languages'])): ?>
				<?php foreach ($value['TechnicalInformation']['programming_languages'] as $val): ?>
					<?php if (isset($programming_languages[$val])): ?>
						<?php $tmp[] = $programming_languages[$val]; ?>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
				<?php echo implode(' , ', $tmp); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>
