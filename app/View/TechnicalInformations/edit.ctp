<script>
$(function(){
	$(document).on('click', '#edit', function(){
		if (!confirm("編集します。よろしいですか？")) return false;
	});
	$(document).on('click', '#delete', function(){
		if (confirm("<?php echo __('削除します。よろしいですか？') ?>")){
			location.href = "<?php echo $this->Html->url(array('controller' => 'TechnicalInformations', 'action' => 'delete', $record['TechnicalInformation']['_id'])); ?>";
			return false;
		}
	});
});
</script>
<div class="ui-corner-all custom-corners">
	<div class="ui-bar ui-bar-a"><h3><?php echo __('技術情報編集'); ?></h3></div>
	<div class="ui-body ui-body-a">
		<?php echo $this->Form->create('TechnicalInformation', array('type' => 'post')); ?>
			<?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $record['TechnicalInformation']['_id'])); ?>
			<?php echo $this->Form->input('title', array('value' => $record['TechnicalInformation']['title'], 'label' => __('タイトル'), 'div' => array('class' => 'ui-field-contain'))); ?>
		<div class="ui-grid-d" style="height: 235px;overflow-y: auto;">
			<div class="ui-block-a ui-group-theme-a ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('business_categories', array('options' => $business_categories, 'value' => $record['TechnicalInformation']['business_categories'], 'label' => __('業種'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-b ui-group-theme-b ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('databases', array('options' => $databases, 'value' => $record['TechnicalInformation']['databases'], 'label' => __('DB'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-c ui-group-theme-e ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('frameworks', array('options' => $frameworks, 'value' => $record['TechnicalInformation']['frameworks'], 'label' => __('フレームワーク'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-d ui-group-theme-f ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('operating_systems', array('options' => $operating_systems, 'value' => $record['TechnicalInformation']['operating_systems'], 'label' => __('OS'), 'multiple' => 'checkbox')); ?>
			</div>
			<div class="ui-block-e ui-group-theme-g ui-mini" style="padding-left: 5px;padding-right: 5px;">
				<?php echo $this->Form->input('programming_languages', array('options' => $programming_languages, 'value' => $record['TechnicalInformation']['programming_languages'], 'label' => __('プログラム言語'), 'multiple' => 'checkbox')); ?>
			</div>
		</div>
		<br>
			<?php echo $this->Form->input('url_evernote', array('value' => $record['TechnicalInformation']['url_evernote'], 'label' => __('Evernote URL'), 'div' => array('class' => 'ui-field-contain'))); ?>
			<?php echo $this->Form->input('url_github', array('value' => $record['TechnicalInformation']['url_github'], 'label' => __('GitHub URL'), 'div' => array('class' => 'ui-field-contain'))); ?>
			<?php echo $this->Form->input('detail', array('type' => 'textarea', 'value' => $record['TechnicalInformation']['detail'], 'label' => __('詳細'))); ?>
			<?php echo $this->Html->div(NULL, NULL, array('style' => 'text-align: center;')); ?>
			<?php echo $this->Html->link(__('戻る'), array('controller' => 'TechnicalInformations', 'action' => 'view', $record['TechnicalInformation']['_id']), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-back', 'ui-btn-icon-left', 'ui-btn-f'))); ?>
			<?php echo $this->Html->tag('button', __('編集'), array('id' => 'edit', 'name' => 'edit', 'class' => array('ui-btn', 'ui-btn-a', 'ui-btn-icon-left', 'ui-icon-flat-new', 'ui-mini', 'ui-btn-inline', 'ui-corner-all', 'ui-btn-b'))); ?>
			<?php echo $this->Html->link(__('削除'), '#', array('id' => 'delete', 'class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-btn-inline', 'ui-icon-flat-cross', 'ui-btn-icon-left', 'ui-btn-d'))); ?>
			<?php echo $this->Html->tag('/div'); ?>
		<?php echo $this->Form->end(); ?>
	</div>
</div>
