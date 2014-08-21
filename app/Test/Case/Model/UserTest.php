<?php
App::uses('User', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property		User $User 社員マスタ
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.user'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->User);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * 社員情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expectedSave = array(
			'User' => array(
				'username' => '53',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => 'テスト'
			)
		);
		$data1 = array(
			'User' => array(
				'username' => '53',
				'password' => '53',
				'name' => 'テスト'
			)
		);
		$this->User->save($data1);
		$lastId = $this->User->getLastInsertID();
		$this->User->id = $lastId;
		$resultSave = $this->User->read(array('username', 'password', 'name'));
		unset($resultSave['User']['_id']);
		$this->assertEquals($expectedSave, $resultSave);

		$expectedGetRecord = array(
			'User' => array(
				'_id' => $lastId,
				'username' => '53',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => 'テスト'
			)
		);
		$resultGetRecord = $this->User->getRecord($lastId);
		unset($resultGetRecord['User']['modified']);
		unset($resultGetRecord['User']['created']);
		$this->assertEquals($expectedGetRecord, $resultGetRecord);

		$expectedUpdate = array(
			'User' => array(
				'username' => '54',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => 'テスト2'
			)
		);
		$data2 = array(
			'User' => array(
				'username' => '54',
				'password' => '',
				'name' => 'テスト2'
			)
		);
		$this->User->id = $lastId;
		$this->User->save($data2);
		$resultUpdate = $this->User->read(array('username', 'password', 'name'));
		unset($resultUpdate['User']['_id']);
		$this->assertEquals($expectedUpdate, $resultUpdate);
	}

/**
 * 社員情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$data1 = array(
			'username' => '',
			'name' => ''
		);
		$tmp1 = $this->User->getList($data1);
		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['User'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['User']['_id']);
			$result2[] = $value;
		}
		$expected2 = array(
			array('User' => array('username' => '53', 'name' => '江里　晃一'))
		);
		$this->assertEquals($expected2, $result2);

		$data2 = array(
			'username' => '53',
			'name' => '江里'
		);
		$tmp2 = $this->User->getList($data2);
		$result3 = array();
		foreach ($tmp2 as $value) {
			unset($value['User']['_id']);
			$result3[] = $value;
		}
		$expected3 = array(
			array('User' => array('username' => '53', 'name' => '江里　晃一'))
		);
		$this->assertEquals($expected3, $result3);
	}

/**
 * バリデーションチェック(false)
 */
	public function testValidationFalse() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array(
			array('username' => array('社員番号は必ず入力してください')),
			array('password' => array('パスワードは必ず入力してください')),
			array('name' => array('氏名は必ず入力してください'))
		);
		$data = array(
			array('User' => array('username' => null, 'password' => '53', 'name' => 'test')),
			array('User' => array('username' => '53', 'password' => null, 'name' => 'test')),
			array('User' => array('username' => '53', 'password' => '53', 'name' => null)),
		);
		$this->User->saveAll($data);
		$this->assertEquals($expected, $this->User->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(array('User' => array('username' => '53', 'password' => '53', 'name' => 'test')));
		$this->User->saveAll($data);
		$this->assertEquals($expected, $this->User->validationErrors);
	}
}
