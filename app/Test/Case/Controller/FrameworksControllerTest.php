<?php
App::uses('FrameworksController', 'Controller');

/**
 * Frameworks Controller Test Case
 * 
 * @package app.Test.Case.Controller
 * @author Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property Framework $Framework フレームワークマスタ
 */
class FrameworksControllerTest extends ControllerTestCase {

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
 * フレームワーク登録画面テスト
 */
	public function testAdd() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 画面描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Frameworks/add', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->_testAction('/Frameworks/add', array('method' => 'get'));
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$expected3 = 'POST';
		$data3 = array('Framework' => array('name' => 'test'));
		$this->_testAction('/Frameworks/add', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 登録されたデータのテスト */
		$expected4 = array('Framework' => array('name' => 'test'));
		$lastId = $this->Framework->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$this->Framework->id = $lastId['Framework']['_id'];
		$result4 = $this->Framework->read(array('name'));
		unset($result4['Framework']['_id']);
		$this->assertEquals($expected4, $result4);

		/** 登録成功時のメッセージのテスト */
		$expected5 = __('登録しました');
		$result5 = CakeSession::read('Message.flash');
		$this->assertEquals($expected5, $result5['message']);

		/** 登録成功時の画面遷移のテスト */
		$expected6 = '/Frameworks/add';
		$this->assertTextContains($expected6, $this->headers['Location']);

		/** 登録失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected7 = __('登録に失敗しました');
		$data7 = array('Framework' => array('name' => null));
		$this->_testAction('/Frameworks/add', array('data' => $data7));
		$result7 = CakeSession::read('Message.flash');
		$this->assertEquals($expected7, $result7['message']);
	}

/**
 * フレームワーク検索画面テスト
 */
	public function testIndex() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Frameworks', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$data3 = array(
			'Frameworks' => array(
				'name' => ''
			)
		);
		$expected3 = 'POST';
		$this->_testAction('/Frameworks', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 取得件数のテスト */
		$expected4 = '11';
		$this->assertEquals($expected4, count($this->vars['list']));
	}

/**
 * フレームワーク編集画面テスト
 */
	public function testEdit() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 編集対象のデータのidを取得 */
		$tmp = $this->Framework->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/Cake/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['Framework']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Frameworks/edit/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'Framework' => array(
				'_id' => $id,
				'name' => 'CakePHP'
			)
		);
		$this->assertEqual($expected3, $this->vars['record']);

		/** postによるアクセステスト */
		$data4 = array(
			'Framework' => array(
				'id' => $id,
				'name' => 'CakePHP2'
			)
		);
		$expected4 = 'POST';
		$this->_testAction('/Frameworks/edit/' . $id, array('data' => $data4));
		$this->assertEquals($expected4, env('REQUEST_METHOD'));

		/** 編集されたデータのテスト */
		$expected5 = array(
			'Framework' => array(
				'_id' => $id,
				'name' => 'CakePHP2'
			)
		);
		$this->Framework->id = $id;
		$result5 = $this->Framework->read(array('_id', 'name'));
		unset($result5['Framework']['created']);
		unset($result5['Framework']['modified']);
		$this->assertEquals($expected5, $result5);

		/** 編集成功時のメッセージのテスト */
		$expected6 = __('編集しました');
		$result6 = CakeSession::read('Message.flash');
		$this->assertEquals($expected6, $result6['message']);

		/** 編集成功時の画面遷移のテスト */
		$expected7 = '/Frameworks';
		$this->assertTextContains($expected7, $this->headers['Location']);

		/** 編集失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$data8 = array(
			'Framework' => array(
				'id' => $id,
				'name' => ''
			)
		);
		$expected8 = __('編集に失敗しました');
		$this->_testAction('/Frameworks/edit/' . $id, array('data' => $data8));
		$result8 = CakeSession::read('Message.flash');
		$this->assertEquals($expected8, $result8['message']);
	}

/**
 * フレームワーク照会画面テスト
 */
	public function testView() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 照会対象のデータのidを取得 */
		$tmp = $this->Framework->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/Cake/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['Framework']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/Frameworks/view/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'Framework' => array(
				'_id' => $id,
				'name' => 'CakePHP'
			)
		);
		$this->assertEquals($expected3, $this->vars['record']);
	}

/**
 * フレームワーク削除処理テスト
 */
	public function testDelete() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 削除対象のデータのidを取得 */
		$tmp = $this->Framework->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/Cake/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['Framework']['_id'];

		/** getによるアクセステスト */
		$this->_testAction('/Frameworks/delete/' . $id, array('method' => 'get'));
		$expected1 = 'GET';
		$this->assertEquals($expected1, env('REQUEST_METHOD'));

		/** データが削除されたかのテスト */
		$expected2 = 0;
		$this->Framework->id = $id;
		$result2 = $this->Framework->read();
		$this->assertEquals($expected2, count($result2));

		/** 削除成功時のメッセージのテスト */
		$expected3 = __('削除しました');
		$result3 = CakeSession::read('Message.flash');
		$this->assertEquals($expected3, $result3['message']);
	}
}
