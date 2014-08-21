<?php
App::uses('AppModel', 'Model');

/**
 * User Model
 * 
 * @package			app.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class User extends AppModel {

/**
 * Validate
 * 
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '社員番号は必ず入力してください',
				'required' => false,
				'allowEmpty' => false
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'パスワードは必ず入力してください',
				'required' => false,
				'allowEmpty' => false,
				'on' => 'create'
			)
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '氏名は必ず入力してください',
				'required' => false,
				'allowEmpty' => false
			)
		),
	);

/**
 * 保存前処理
 * 
 * @param array $options
 * @return boolean
 */
	public function beforeSave($options = array()) {
		if (!empty($this->data[$this->name]['password'])) {
			$this->data[$this->name]['password'] = AuthComponent::password($this->data[$this->name]['password']);
		} else {
			unset($this->data[$this->name]['password']);
		}
		return true;
	}

/**
 * 検索条件設定
 * 
 * @param array $data 検索パラメータ
 */
	public function setConditions($data = array()) {
		$this->conditions = array();
		if (!empty($data['username'])) {
			$this->conditions['username'] = $data['username'];
		}
		if (!empty($data['name'])) {
			$this->conditions['name'] = new MongoRegex('/' . $data['name'] . '/i');
		}
	}

/**
 * 取得項目設定
 */
	public function setFields() {
		$this->fields = array('_id', 'username', 'name');
	}

/**
 * 表示順設定
 */
	public function setOrder() {
		$this->order = array('username');
	}
}
