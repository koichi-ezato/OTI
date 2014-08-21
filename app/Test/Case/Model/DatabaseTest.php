<?php
App::uses('Database', 'Model');
APP::uses('AuthComponent', 'Controller/Component');

/**
 * Database Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property Database $Database DBマスタ
 */
class DatabaseTest extends CakeTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.database'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->Database = ClassRegistry::init('Database');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->Database);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * DB情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array('Database' => array('name' => 'Oracle'));
		$data1 = array('Database' => array('name' => 'Oracle'));
		$this->Database->save($data1);
		$lastId = $this->Database->getLastInsertID();
		$this->Database->id = $lastId;
		$result1 = $this->Database->read(array('name'));
		unset($result1['Database']['_id']);
		$this->assertEquals($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array('Database' => array('_id' => $lastId, 'name' => 'Oracle'));
		$result2 = $this->Database->getRecord($lastId);
		unset($result2['Database']['created']);
		unset($result2['Database']['modified']);
		$this->assertEquals($expected2, $result2);

		/** updateテスト */
		$expected3 = array('Database' => array('name' => 'ORACLE'));
		$data3 = array('Database' => array('name' => 'ORACLE'));
		$this->Database->id = $lastId;
		$this->Database->save($data3);
		$result3 = $this->Database->read(array('name'));
		unset($result3['Database']['_id']);
		$this->assertEquals($expected3, $result3);
	}

/**
 * DB情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$data1 = array(
			'name' => ''
		);
		$tmp1 = $this->Database->getList($data1);
		debug($tmp1);
		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['Database'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);

		$expected2 = array(
			array('Database' => array('name' => 'H2 Database')),
			array('Database' => array('name' => 'MongoDB')),
			array('Database' => array('name' => 'MySQL')),
			array('Database' => array('name' => 'PostgreSQL')),
			array('Database' => array('name' => 'SQLite')),
			array('Database' => array('name' => 'DB2')),
			array('Database' => array('name' => 'HiRDB')),
			array('Database' => array('name' => 'Access')),
			array('Database' => array('name' => 'SQL Server')),
			array('Database' => array('name' => 'Oracle')),
		);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['Database']['_id']);
			$result2[] = $value;
		}
		$this->assertEquals($expected2, $result2);

		$data3 = array(
			'name' => 'My'
		);
		$tmp3 = $this->Database->getList($data3);
		$expected3 = array(
			array('Database' => array('name' => 'MySQL')),
		);
		$result3 = array();
		foreach ($tmp3 as $value) {
			unset($value['Database']['_id']);
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
			array('Database' => array('name' => null))
		);
		$this->Database->saveAll($data);
		$this->assertEquals($expected, $this->Database->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('Database' => array('name' => 'test'))
		);
		$this->Database->saveAll($data);
		$this->assertEquals($expected, $this->Database->validationErrors);
	}
}
