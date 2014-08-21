<?php
App::uses('ProgrammingLanguagesController', 'Controller');

/**
 * ProgrammingLanguages Controller Test Case
 * 
 * @package app.Test.Case.Controller
 * @author Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property ProgrammingLanguage $ProgrammingLanguage プログラム言語マスタ
 */
class ProgrammingLanguagesControllerTest extends ControllerTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.programming_language'
	);

/**
 * setUp method
 * 
 * @return void
 */
	public function setUp() {
		CakeSession::start();
		parent::setUp();
		$this->ProgrammingLanguage = ClassRegistry::init('ProgrammingLanguage');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->ProgrammingLanguage);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * プログラム言語登録画面テスト
 */
	public function testAdd() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 画面描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/ProgrammingLanguages/add', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->_testAction('/ProgrammingLanguages/add', array('method' => 'get'));
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$expected3 = 'POST';
		$data3 = array('ProgrammingLanguage' => array('name' => 'test'));
		$this->_testAction('/ProgrammingLanguages/add', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 登録されたデータのテスト */
		$expected4 = array('ProgrammingLanguage' => array('name' => 'test'));
		$lastId = $this->ProgrammingLanguage->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$this->ProgrammingLanguage->id = $lastId['ProgrammingLanguage']['_id'];
		$result4 = $this->ProgrammingLanguage->read(array('name'));
		unset($result4['ProgrammingLanguage']['_id']);
		$this->assertEquals($expected4, $result4);

		/** 登録成功時のメッセージのテスト */
		$expected5 = __('登録しました');
		$result5 = CakeSession::read('Message.flash');
		$this->assertEquals($expected5, $result5['message']);

		/** 登録成功時の画面遷移のテスト */
		$expected6 = '/ProgrammingLanguages/add';
		$this->assertTextContains($expected6, $this->headers['Location']);

		/** 登録失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected7 = __('登録に失敗しました');
		$data7 = array('ProgrammingLanguage' => array('name' => null));
		$this->_testAction('/ProgrammingLanguages/add', array('data' => $data7));
		$result7 = CakeSession::read('Message.flash');
		$this->assertEquals($expected7, $result7['message']);
	}

/**
 * プログラム言語検索画面テスト
 */
	public function testIndex() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/ProgrammingLanguages', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** postによるアクセステスト */
		$data3 = array(
			'ProgrammingLanguages' => array(
				'name' => ''
			)
		);
		$expected3 = 'POST';
		$this->_testAction('/ProgrammingLanguages', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 取得件数のテスト */
		$expected4 = '20';
		$this->assertEquals($expected4, count($this->vars['list']));
	}

/**
 * プログラム言語編集画面テスト
 */
	public function testEdit() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 編集対象のデータのidを取得 */
		$tmp = $this->ProgrammingLanguage->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/PHP/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['ProgrammingLanguage']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/ProgrammingLanguages/edit/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'ProgrammingLanguage' => array(
				'_id' => $id,
				'name' => 'PHP'
			)
		);
		$this->assertEqual($expected3, $this->vars['record']);

		/** postによるアクセステスト */
		$data4 = array(
			'ProgrammingLanguage' => array(
				'id' => $id,
				'name' => 'PHP2'
			)
		);
		$expected4 = 'POST';
		$this->_testAction('/ProgrammingLanguages/edit/' . $id, array('data' => $data4));
		$this->assertEquals($expected4, env('REQUEST_METHOD'));

		/** 編集されたデータのテスト */
		$expected5 = array(
			'ProgrammingLanguage' => array(
				'_id' => $id,
				'name' => 'PHP2'
			)
		);
		$this->ProgrammingLanguage->id = $id;
		$result5 = $this->ProgrammingLanguage->read(array('_id', 'name'));
		unset($result5['ProgrammingLanguage']['created']);
		unset($result5['ProgrammingLanguage']['modified']);
		$this->assertEquals($expected5, $result5);

		/** 編集成功時のメッセージのテスト */
		$expected6 = __('編集しました');
		$result6 = CakeSession::read('Message.flash');
		$this->assertEquals($expected6, $result6['message']);

		/** 編集成功時の画面遷移のテスト */
		$expected7 = '/ProgrammingLanguages';
		$this->assertTextContains($expected7, $this->headers['Location']);

		/** 編集失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$data8 = array(
			'ProgrammingLanguage' => array(
				'id' => $id,
				'name' => ''
			)
		);
		$expected8 = __('編集に失敗しました');
		$this->_testAction('/ProgrammingLanguages/edit/' . $id, array('data' => $data8));
		$result8 = CakeSession::read('Message.flash');
		$this->assertEquals($expected8, $result8['message']);
	}

/**
 * プログラム言語照会画面テスト
 */
	public function testView() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 照会対象のデータのidを取得 */
		$tmp = $this->ProgrammingLanguage->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/PHP/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['ProgrammingLanguage']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/ProgrammingLanguages/view/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'ProgrammingLanguage' => array(
				'_id' => $id,
				'name' => 'PHP'
			)
		);
		$this->assertEquals($expected3, $this->vars['record']);
	}

/**
 * プログラム言語削除処理テスト
 */
	public function testDelete() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 削除対象のデータのidを取得 */
		$tmp = $this->ProgrammingLanguage->find('first', array('fields' => array('_id'), 'conditions' => array('name' => new MongoRegex('/PHP/i')), 'order' => array('modified' => 'DESC')));
		$id = $tmp['ProgrammingLanguage']['_id'];

		/** getによるアクセステスト */
		$this->_testAction('/ProgrammingLanguages/delete/' . $id, array('method' => 'get'));
		$expected1 = 'GET';
		$this->assertEquals($expected1, env('REQUEST_METHOD'));

		/** データが削除されたかのテスト */
		$expected2 = 0;
		$this->ProgrammingLanguage->id = $id;
		$result2 = $this->ProgrammingLanguage->read();
		$this->assertEquals($expected2, count($result2));

		/** 削除成功時のメッセージのテスト */
		$expected3 = __('削除しました');
		$result3 = CakeSession::read('Message.flash');
		$this->assertEquals($expected3, $result3['message']);
	}
}
