<?php
App::uses('AppModel', 'Model');

/**
 * Database Model
 * 
 * @package			app.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class Database extends AppModel {

/**
 * Validate
 * 
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '名称は必ず入力してください',
				'required' => false,
				'allowEmpty' => false
			)
		)
	);

/**
 * 検索条件設定
 * 
 * @param array $data 検索パラメータ
 */
	public function setConditions($data = array()) {
		$this->conditions = array();
		if (!empty($data['name'])) {
			$this->conditions['name'] = new MongoRegex('/' . $data['name'] . '/i');
		}
	}

/**
 * 取得項目設定
 */
	public function setFields() {
		$this->fields = array('_id', 'name');
	}

/**
 * 表示順設定
 */
	public function setOrder() {
		$this->order = array('name');
	}
}
