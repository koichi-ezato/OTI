<?php
App::uses('UsersController', 'Controller');

/**
 * Users Controller Test Case
 * 
 * @package app.Test.Case.Controller
 * @author Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property User $User 社員マスタ
 */
class UsersControllerTest extends ControllerTestCase {

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
 * ログイン画面テスト
 */
	public function testLogin() {
		/** 画面描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->_testAction('/', array('method' => 'get'));
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$expected3 = 'POST';
		$this->_testAction('/', array('method' => 'post'));
		$this->assertEqual($expected3, env('REQUEST_METHOD'));

		/** ログイン成功時のテスト */
		CakeSession::destroy();
		$expected4 = '/Menu';
		$this->_testAction('/', array('data' => array('User' => array('username' => '53', 'password' => '53'))));
		$this->assertTextContains($expected4, $this->headers['Location']);

		/** ログイン失敗時のテスト */
		CakeSession::destroy();
		$expected5 = __('ログインに失敗しました');
		$this->_testAction('/', array('data' => array('User' => array('username' => '53', 'password' => '5'))));
		$result5 = CakeSession::read('Message.flash');
		$this->assertEquals($expected5, $result5['message']);

		/** ログイン→ログアウト時のテスト */
		CakeSession::destroy();
		$this->_testAction('/', array('data' => array('User' => array('username' => '53', 'password' => '53'))));
		$this->_testAction('/', array('method' => 'get'));
		$result6 = AuthComponent::user();
		$this->assertNull($result6);
	}

/**
 * 社員登録画面テスト
 */
	public function testAdd() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 画面描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Users/add', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->_testAction('/Users/add', array('method' => 'get'));
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$expected3 = 'POST';
		$data = array('User' => array('username' => '53', 'password' => '53', 'name' => 'test'));
		$this->_testAction('/Users/add', array('method' => 'post', 'data' => $data));
		$this->assertEqual($expected3, env('REQUEST_METHOD'));

		/** 登録されたデータのテスト */
		$expected4 = array('User' => array('username' => '53', 'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b', 'name' => 'test'));
		$lastId = $this->User->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$this->User->id = $lastId['User']['_id'];
		$result4 = $this->User->read(array('username' => '53', 'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b', 'name' => 'test'));
		unset($result4['User']['_id']);
		$this->assertEquals($expected4, $result4);

		/** 登録成功時のメッセージのテスト */
		$expected5 = __('登録しました');
		$result5 = CakeSession::read('Message.flash');
		$this->assertEquals($expected5, $result5['message']);

		/** 登録成功時の画面遷移のテスト */
		$expected6 = '/Users/add';
		$this->assertTextContains($expected6, $this->headers['Location']);

		/** 登録失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected7 = __('登録に失敗しました');
		$data = array('User' => array('username' => null, 'password' => '53', 'name' => 'test'));
		$this->_testAction('/Users/add', array('data' => $data));
		$result7 = CakeSession::read('Message.flash');
		$this->assertEquals($expected7, $result7['message']);
	}

/**
 * 社員検索画面テスト
 */
	public function testIndex() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Users', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$data1 = array(
			'Users' => array(
				'username' => '',
				'name' => ''
			)
		);
		$expected3 = 'POST';
		$this->_testAction('/Users', array('data' => $data1));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 取得件数のテスト */
		$expected4 = '1';
		$this->assertEquals($expected4, count($this->vars['list']));
	}

/**
 * 社員編集画面テスト
 */
	public function testEdit() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 編集対象のデータのidを取得 */
		$tmp = $this->User->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['User']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Users/edit/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'User' => array(
				'_id' => $id,
				'username' => '53',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => '江里　晃一'
			)
		);
		$this->assertEqual($expected3, $this->vars['record']);

		/** postによるアクセステスト */
		$data1 = array(
			'User' => array(
				'id' => $id,
				'username' => '53',
				'password' => '',
				'name' => 'test'
			)
		);
		$expected4 = 'POST';
		$this->_testAction('/Users/edit/' . $id, array('data' => $data1));
		$this->assertEquals($expected4, env('REQUEST_METHOD'));

		/** 編集されたデータのテスト */
		$expected5 = array(
			'User' => array(
				'_id' => $id,
				'username' => '53',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => 'test'
			)
		);
		$this->User->id = $id;
		$result5 = $this->User->read(array('_id', 'username', 'password', 'name'));
		unset($result5['User']['created']);
		unset($result5['User']['modified']);
		$this->assertEquals($expected5, $result5);

		/** 編集成功時のメッセージのテスト */
		$expected6 = __('編集しました');
		$result6 = CakeSession::read('Message.flash');
		$this->assertEquals($expected6, $result6['message']);

		/** 編集成功時の画面遷移のテスト */
		$expected7 = '/Users';
		$this->assertTextContains($expected7, $this->headers['Location']);

		/** 編集失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$data2 = array(
			'User' => array(
				'id' => $id,
				'username' => '',
				'password' => '',
				'name' => ''
			)
		);
		$expected8 = __('編集に失敗しました');
		$this->_testAction('/Users/edit/' . $id, array('data' => $data2));
		$result8 = CakeSession::read('Message.flash');
		$this->assertEquals($expected8, $result8['message']);
	}

/**
 * 社員照会画面テスト
 */
	public function testView() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 照会対象のデータのidを取得 */
		$tmp = $this->User->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['User']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Users/view/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'User' => array(
				'_id' => $id,
				'username' => '53',
				'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
				'name' => '江里　晃一'
			)
		);
		$this->assertEqual($expected3, $this->vars['record']);
	}

/**
 * 社員削除処理テスト
 */
	public function testDelete() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 削除対象のデータのidを取得 */
		$tmp = $this->User->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['User']['_id'];

		/** getによるアクセステスト */
		$this->_testAction('/Users/delete/' . $id, array('method' => 'get'));
		$expected1 = 'GET';
		$this->assertEquals($expected1, env('REQUEST_METHOD'));

		/** データが削除されたかのテスト */
		$expected2 = 0;
		$this->User->id = $id;
		$result2 = $this->User->read();
		$this->assertEqual($expected2, count($result2));

		/** 削除成功時のメッセージのテスト */
		$expected3 = __('削除しました');
		$result3 = CakeSession::read('Message.flash');
		$this->assertEquals($expected3, $result3['message']);
	}
}
