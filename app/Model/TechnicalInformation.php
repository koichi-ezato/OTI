<?php
App::uses('AppModel', 'Model');

/**
 * TechnicalInformation Model
 * 
 * @package app.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class TechnicalInformation extends AppModel {

/**
 * Validate
 * 
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'タイトルは必ず入力してください',
				'required' => false,
				'allowEmpty' => false
			)
		),
		'detail' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => '詳細は必ず入力してください',
				'required' => false,
				'allowEmpty' => false
			)
		),
		'url_evernote' => array(
			'url' => array(
				'rule' => 'url',
				'message' => 'URLが不正です',
				'required' => false,
				'allowEmpty' => true
			)
		),
		'url_github' => array(
			'url' => array(
				'rule' => 'url',
				'message' => 'URLが不正です',
				'required' => false,
				'allowEmpty' => true
			)
		),
	);

/**
 * 検索条件設定
 * 
 * @param array $data 検索パラメータ
 */
	public function setConditions($data = array()) {
		$this->conditions = array();
		if (!empty($data['title'])) {
			$this->conditions['title'] = new MongoRegex('/' . $data['title'] . '/i');
		}
		if (!empty($data['business_categories'])) {
			$this->conditions['business_categories']['$in'] = $data['business_categories'];
		}
		if (!empty($data['programming_languages'])) {
			$this->conditions['programming_languages']['$in'] = $data['programming_languages'];
		}
		if (!empty($data['frameworks'])) {
			$this->conditions['frameworks']['$in'] = $data['frameworks'];
		}
		if (!empty($data['operating_systems'])) {
			$this->conditions['operating_systems']['$in'] = $data['operating_systems'];
		}
		if (!empty($data['databases'])) {
			$this->conditions['databases']['$in'] = $data['databases'];
		}
	}

/**
 * 表示順設定
 */
	public function setOrder() {
		$this->order = array('title');
	}
}
