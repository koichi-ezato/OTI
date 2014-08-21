<?php
App::uses('BusinessCategory', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * BusinessCategory Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property BusinessCategory $BusinessCategory 業務マスタ
 */
class BusinessCategoryTest extends CakeTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.business_category'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->BusinessCategory = ClassRegistry::init('BusinessCategory');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->BusinessCategory);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * 業種情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array('BusinessCategory' => array('name' => 'レンタル'));
		$data1 = array('BusinessCategory' => array('name' => 'レンタル'));
		$this->BusinessCategory->save($data1);
		$lastId = $this->BusinessCategory->getLastInsertID();
		$this->BusinessCategory->id = $lastId;
		$result1 = $this->BusinessCategory->read(array('name'));
		unset($result1['BusinessCategory']['_id']);
		$this->assertEquals($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array('BusinessCategory' => array('_id' => $lastId, 'name' => 'レンタル'));
		$result2 = $this->BusinessCategory->getRecord($lastId);
		unset($result2['BusinessCategory']['modified']);
		unset($result2['BusinessCategory']['created']);
		$this->assertEquals($expected2, $result2);

		/** updateテスト */
		$expected3 = array('BusinessCategory' => array('name' => 'レンタル2'));
		$data2 = array('BusinessCategory' => array('name' => 'レンタル2'));
		$this->BusinessCategory->id = $lastId;
		$this->BusinessCategory->save($data2);
		$result3 = $this->BusinessCategory->read(array('name'));
		unset($result3['BusinessCategory']['_id']);
		$this->assertEquals($expected3, $result3);
	}

/**
 * 業種情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$data1 = array(
			'name' => ''
		);
		$tmp1 = $this->BusinessCategory->getList($data1);

		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['BusinessCategory'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);

		$expected2 = array(
			array('BusinessCategory' => array('name' => 'レンタル')),
			array('BusinessCategory' => array('name' => '不動産')),
			array('BusinessCategory' => array('name' => '損保')),
			array('BusinessCategory' => array('name' => '旅行')),
			array('BusinessCategory' => array('name' => '物流')),
			array('BusinessCategory' => array('name' => '生保')),
			array('BusinessCategory' => array('name' => '病院')),
			array('BusinessCategory' => array('name' => '官公庁')),
			array('BusinessCategory' => array('name' => '自動車')),
			array('BusinessCategory' => array('name' => '製造')),
			array('BusinessCategory' => array('name' => '量販店')),
			array('BusinessCategory' => array('name' => '金融')),
			array('BusinessCategory' => array('name' => '鉄鋼')),
		);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['BusinessCategory']['_id']);
			$result2[] = $value;
		}
		$this->assertEquals($expected2, $result2);

		$data3 = array(
			'name' => '保'
		);
		$tmp3 = $this->BusinessCategory->getList($data3);
		$expected3 = array(
			array('BusinessCategory' => array('name' => '損保')),
			array('BusinessCategory' => array('name' => '生保')),
		);
		$result3 = array();
		foreach ($tmp3 as $value) {
			unset($value['BusinessCategory']['_id']);
			$result3[] = $value;
		}
		$this->assertEquals($expected3, $result3);
	}

/**
 * バリデーションチェック(false)
 */
	public function testValidationFalse() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array(
			array('name' => array('名称は必ず入力してください'))
		);
		$data = array(
			array('BusinessCategory' => array('name' => null))
		);
		$this->BusinessCategory->saveAll($data);
		$this->assertEquals($expected, $this->BusinessCategory->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('BusinessCategory' => array('name' => 'test'))
		);
		$this->BusinessCategory->saveAll($data);
		$this->assertEquals($expected, $this->BusinessCategory->validationErrors);
	}
}
