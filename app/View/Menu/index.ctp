<?php
echo $this->Html->link(__('技術情報登録'), array('controller' => 'TechnicalInformations', 'action' => 'add'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-flat-bubble', 'ui-btn-icon-left', 'ui-btn-a')));
echo $this->Html->link(__('技術情報検索'), array('controller' => 'TechnicalInformations', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-flat-menu', 'ui-btn-icon-left', 'ui-btn-a')));
?>
<br>
<?php
echo $this->Html->link(__('ユーザ管理'), array('controller' => 'Users', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-flat-man', 'ui-btn-icon-left', 'ui-btn-g')));
echo $this->Html->link(__('業種情報管理'), array('controller' => 'BusinessCategories', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-shop', 'ui-btn-icon-left', 'ui-btn-g')));
echo $this->Html->link(__('データベース情報管理'), array('controller' => 'Databases', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-grid', 'ui-btn-icon-left', 'ui-btn-g')));
echo $this->Html->link(__('フレームワーク情報管理'), array('controller' => 'Frameworks', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-flat-settings', 'ui-btn-icon-left', 'ui-btn-g')));
echo $this->Html->link(__('OS情報管理'), array('controller' => 'OperatingSystems', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-flat-cmd', 'ui-btn-icon-left', 'ui-btn-g')));
echo $this->Html->link(__('プログラム言語情報管理'), array('controller' => 'ProgrammingLanguages', 'action' => 'index'), array('class' => array('ui-btn', 'ui-mini', 'ui-corner-all', 'ui-icon-bullets', 'ui-btn-icon-left', 'ui-btn-g')));
