<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

/**
 * 使用するDBの定義情報参照先
 * テストが終了したらコメントアウト
 * 
 * @var string
 */
//	public $useDbConfig = 'test';

/**
 * 検索対象フィールド格納配列
 * 
 * @var array
 */
	public $fields = array();

/**
 * 検索条件格納配列
 * 
 * @var array
 */
	public $conditions = array();

/**
 * テーブル結合条件格納配列
 * 
 * @var array
 */
	public $joins = array();

/**
 * 表示順序格納配列
 * 
 * @var array
 */
	public $order = array();

/**
 * グループ化情報格納配列
 * 
 * @var array
 */
	public $group = array();

/**
 * クエリ発行パラメータ格納配列
 * @var array
 */
	public $params = array();

/**
 * 主キー
 * @var string 主キー
 */
	public $primaryKey = '_id';

/**
 * 検索条件設定
 * 
 * @param array $data 検索パラメータ
 * @return boolean
 */
	public function setConditions($data = array()) {
		return true;
	}

/**
 * 取得項目設定
 * 
 * @return boolean
 */
	public function setFields() {
		return true;
	}

/**
 * 表示順設定
 * 
 * @return boolean
 */
	public function setOrder() {
		return true;
	}

/**
 * リスト取得処理
 * 
 * @param array $data 検索パラメータ
 * @return array リスト
 */
	public function getList($data) {
		$this->setConditions($data);
		$this->setFields();
		$this->setOrder();
		
		$this->params = array('fields' => $this->fields, 'order' => $this->order, 'conditions' => $this->conditions);

		$result = $this->find('all', $this->params);

		return $result;
	}

/**
 * 単一レコード取得
 * 
 * @param integer $id
 * @return array 単一レコード
 */
	public function getRecord($id) {
		$this->id = $id;
		return $this->read();
	}

/**
 * セレクトボックス生成
 * 
 * @return array
 */
	public function getSelectboxValues() {
		$result = array();

		$this->fields = array('_id', 'name');
		$this->order = array('name');

		$this->params = array('fields' => $this->fields, 'order' => $this->order);

		$result = $this->find('list', $this->params);

		return $result;
	}
}
