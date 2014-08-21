<?php
App::uses('Framework', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * Framework Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property Framework $Framework フレームワークマスタ
 */
class FrameworkTest extends CakeTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.framework'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->Framework = ClassRegistry::init('Framework');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->Framework);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * フレームワーク情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array('Framework' => array('name' => 'Oracle'));
		$data1 = array('Framework' => array('name' => 'Oracle'));
		$this->Framework->save($data1);
		$lastId = $this->Framework->getLastInsertID();
		$this->Framework->id = $lastId;
		$result1 = $this->Framework->read(array('name'));
		unset($result1['Framework']['_id']);
		$this->assertEquals($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array('Framework' => array('_id' => $lastId, 'name' => 'Oracle'));
		$result2 = $this->Framework->getRecord($lastId);
		unset($result2['Framework']['modified']);
		unset($result2['Framework']['created']);
		$this->assertEquals($expected2, $result2);

		/** updateテスト */
		$expected3 = array('Framework' => array('name' => 'Oracle2'));
		$data2 = array('Framework' => array('name' => 'Oracle2'));
		$this->Framework->id = $lastId;
		$this->Framework->save($data2);
		$result3 = $this->Framework->read(array('name'));
		unset($result3['Framework']['_id']);
		$this->assertEquals($expected3, $result3);
	}

/**
 * フレームワーク情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$data1 = array(
			'name' => ''
		);
		$tmp1 = $this->Framework->getList($data1);
		
		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['Framework'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);

		$expected2 = array(
			array('Framework' => array('name' => 'ASP.NET')),
			array('Framework' => array('name' => 'Struts')),
			array('Framework' => array('name' => 'Spring')),
			array('Framework' => array('name' => 'CakePHP')),
			array('Framework' => array('name' => 'CodeIgniter')),
			array('Framework' => array('name' => 'FuelPHP')),
			array('Framework' => array('name' => 'Symfony')),
			array('Framework' => array('name' => 'Zend')),
			array('Framework' => array('name' => 'Ruby on Rails')),
			array('Framework' => array('name' => 'Django')),
			array('Framework' => array('name' => 'Flask')),
		);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['Framework']['_id']);
			$result2[] = $value;
		}
		$this->assertEquals($expected2, $result2);

		$data3 = array(
			'name' => 'PHP'
		);
		$tmp3 = $this->Framework->getList($data3);
		$expected3 = array(
			array('Framework' => array('name' => 'CakePHP')),
			array('Framework' => array('name' => 'FuelPHP')),
		);
		$result3 = array();
		foreach ($tmp3 as $value) {
			unset($value['Framework']['_id']);
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
			array('Framework' => array('name' => null))
		);
		$this->Framework->saveAll($data);
		$this->assertEquals($expected, $this->Framework->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('Framework' => array('name' => 'test'))
		);
		$this->Framework->saveAll($data);
		$this->assertEquals($expected, $this->Framework->validationErrors);
	}
}
