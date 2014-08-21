<?php
App::uses('OperatingSystem', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * OperatingSystem Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property OperatingSystem $OperatingSystem OSマスタ
 */
class OperatingSystemTest extends CakeTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.operating_system'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->OperatingSystem = ClassRegistry::init('OperatingSystem');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->OperatingSystem);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * OS情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array('OperatingSystem' => array('name' => 'Linux'));
		$data1 = array('OperatingSystem' => array('name' => 'Linux'));
		$this->OperatingSystem->save($data1);
		$lastId = $this->OperatingSystem->getLastInsertID();
		$this->OperatingSystem->id = $lastId;
		$result1 = $this->OperatingSystem->read(array('name'));
		unset($result1['OperatingSystem']['_id']);
		$this->assertEquals($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array('OperatingSystem' => array('_id' => $lastId, 'name' => 'Linux'));
		$result2 = $this->OperatingSystem->getRecord($lastId);
		unset($result2['OperatingSystem']['modified']);
		unset($result2['OperatingSystem']['created']);
		$this->assertEquals($expected2, $result2);

		/** updateテスト */
		$expected3 = array('OperatingSystem' => array('name' => 'Linux2'));
		$data2 = array('OperatingSystem' => array('name' => 'Linux2'));
		$this->OperatingSystem->id = $lastId;
		$this->OperatingSystem->save($data2);
		$result3 = $this->OperatingSystem->read(array('name'));
		unset($result3['OperatingSystem']['_id']);
		$this->assertEquals($expected3, $result3);
	}

/**
 * OS情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$data1 = array(
			'name' => ''
		);
		$tmp1 = $this->OperatingSystem->getList($data1);

		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['OperatingSystem'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);

		$expected2 = array(
			array('OperatingSystem' => array('name' => 'Mac OS X')),
			array('OperatingSystem' => array('name' => 'iOS')),
			array('OperatingSystem' => array('name' => 'Windows Server 2008')),
			array('OperatingSystem' => array('name' => 'Windows 7')),
			array('OperatingSystem' => array('name' => 'Windows 8')),
			array('OperatingSystem' => array('name' => 'UNIX')),
			array('OperatingSystem' => array('name' => 'Linux')),
			array('OperatingSystem' => array('name' => 'Android')),
			array('OperatingSystem' => array('name' => 'Firefox OS')),
		);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['OperatingSystem']['_id']);
			$result2[] = $value;
		}
		$this->assertEquals($expected2, $result2);

		$data3 = array(
			'name' => 'OS'
		);
		$tmp3 = $this->OperatingSystem->getList($data3);
		$expected3 = array(
			array('OperatingSystem' => array('name' => 'Mac OS X')),
			array('OperatingSystem' => array('name' => 'iOS')),
			array('OperatingSystem' => array('name' => 'Firefox OS')),
		);
		$result3 = array();
		foreach ($tmp3 as $value) {
			unset($value['OperatingSystem']['_id']);
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
			array('OperatingSystem' => array('name' => null))
		);
		$this->OperatingSystem->saveAll($data);
		$this->assertEquals($expected, $this->OperatingSystem->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('OperatingSystem' => array('name' => 'test'))
		);
		$this->OperatingSystem->saveAll($data);
		$this->assertEquals($expected, $this->OperatingSystem->validationErrors);
	}
}
