<?php
APP::uses('TechnicalInformationsController', 'Controller');

/**
 * TechnicalInformations Controller Test Case
  * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property BusinessCategory $BusinessCategory 業務マスタ
 * @property Database $Database DBマスタ
 * @property Framework $Framework フレームワークマスタ
 * @property OperatingSystem $OperatingSystem OSマスタ
 * @property ProgrammingLanguage $ProgrammingLanguage プログラム言語マスタ
 * @property TechnicalInformation $TechnicalInformation 技術情報
 */
class TechnicalInformationsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 * 
 * @var array
 */
	public $fixtures = array(
		'app.technical_information',
		'app.business_category',
		'app.database',
		'app.framework',
		'app.operating_system',
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
		$this->TechnicalInformation = ClassRegistry::init('TechnicalInformation');
		$this->BusinessCategory = ClassRegistry::init('BusinessCategory');
		$this->Database = ClassRegistry::init('Database');
		$this->Framework = ClassRegistry::init('Framework');
		$this->OperatingSystem = ClassRegistry::init('OperatingSystem');
		$this->ProgrammingLanguage = ClassRegistry::init('ProgrammingLanguage');
	}

/**
 * tearDown method
 * 
 * @return void
 */
	public function tearDown() {
		unset($this->TechnicalInformation);
		unset($this->BusinessCategory);
		unset($this->Database);
		unset($this->Framework);
		unset($this->OperatingSystem);
		unset($this->ProgrammingLanguage);
		parent::tearDown();
		CakeSession::destroy();
	}

/**
 * 技術情報登録画面テスト
 */
	public function testAdd() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 画面描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/TechnicalInformations/add', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** 業種リスト取得テスト */
		$expected8 = array(
			'レンタル', '不動産', '損保', '旅行',
			'物流', '生保', '病院', '官公庁',
			'自動車', '製造', '量販店', '金融', '鉄鋼'
		);
		$tmp8 = $this->vars['business_categories'];
		$result8 = array();
		foreach ($tmp8 as $value) {
			$result8[] = $value;
		}
		$this->assertEquals($expected8, $result8);

		/** DBリスト取得テスト */
		$expected9 = array(
			'H2 Database', 'MongoDB', 'MySQL', 'PostgreSQL',
			'SQLite', 'DB2', 'HiRDB', 'Access',
			'SQL Server', 'Oracle'
		);
		$tmp9 = $this->vars['databases'];
		$result9 = array();
		foreach ($tmp9 as $value) {
			$result9[] = $value;
		}
		$this->assertEquals($expected9, $result9);

		/** フレームワークリスト取得テスト */
		$expected10 = array(
			'ASP.NET', 'Struts', 'Spring', 'CakePHP',
			'CodeIgniter', 'FuelPHP', 'Symfony', 'Zend',
			'Ruby on Rails', 'Django', 'Flask'
		);
		$tmp10 = $this->vars['frameworks'];
		$result10 = array();
		foreach ($tmp10 as $value) {
			$result10[] = $value;
		}
		$this->assertEquals($expected10, $result10);

		/** OSリスト取得テスト */
		$expected11 = array(
			'Mac OS X', 'iOS', 'Windows Server 2008', 'Windows 7',
			'Windows 8', 'UNIX', 'Linux', 'Android',
			'Firefox OS'
		);
		$tmp11 = $this->vars['operating_systems'];
		$result11 = array();
		foreach ($tmp11 as $value) {
			$result11[] = $value;
		}
		$this->assertEquals($expected11, $result11);

		/** プログラム言語リスト取得テスト */
		$expected12 = array(
			'Bash', 'C', 'C#', 'C++',
			'CASL', 'COBOL', 'Delphi', 'FORTRAN',
			'Go', 'Haskell', 'Java', 'JavaScript',
			'Objective-C', 'Pascal', 'Perl', 'PHP',
			'PowerShell', 'Python', 'Ruby', 'Scala'
		);
		$tmp12 = $this->vars['programming_languages'];
		$result12 = array();
		foreach ($tmp12 as $value) {
			$result12[] = $value;
		}
		$this->assertEquals($expected12, $result12);

		/** postによるアクセステスト */
		$expected3 = 'POST';
		$data3 = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));

		/** 登録されたデータのテスト */
		$expected4 = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$lastId = $this->TechnicalInformation->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$this->TechnicalInformation->id = $lastId['TechnicalInformation']['_id'];
		$result4 = $this->TechnicalInformation->read(array('title', 'business_categories', 'databases', 'frameworks', 'operating_systems', 'programming_languages', 'url_evernote', 'url_github', 'detail'));
		unset($result4['TechnicalInformation']['_id']);
		$this->assertEquals($expected4, $result4);

		/** 登録成功時のメッセージのテスト */
		$expected5 = __('登録しました');
		$result5 = CakeSession::read('Message.flash');
		$this->assertEquals($expected5, $result5['message']);

		/** 登録成功時の画面遷移のテスト */
		$expected6 = '/TechnicalInformations/add';
		$this->assertTextContains($expected6, $this->headers['Location']);

		/** 登録失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected7 = __('登録に失敗しました');
		$data7 = array(
			'TechnicalInformation' => array(
				'title' => '',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $data7));
		$result7 = CakeSession::read('Message.flash');
		$this->assertEquals($expected7, $result7['message']);
	}

/**
 * 技術情報検索画面テスト
 */
	public function testIndex() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/TechnicalInformations', array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEquals($expected2, env('REQUEST_METHOD'));

		/** 業種リスト取得テスト */
		$expected8 = array(
			'レンタル', '不動産', '損保', '旅行',
			'物流', '生保', '病院', '官公庁',
			'自動車', '製造', '量販店', '金融', '鉄鋼'
		);
		$tmp8 = $this->vars['business_categories'];
		$result8 = array();
		foreach ($tmp8 as $value) {
			$result8[] = $value;
		}
		$this->assertEquals($expected8, $result8);

		/** DBリスト取得テスト */
		$expected9 = array(
			'H2 Database', 'MongoDB', 'MySQL', 'PostgreSQL',
			'SQLite', 'DB2', 'HiRDB', 'Access',
			'SQL Server', 'Oracle'
		);
		$tmp9 = $this->vars['databases'];
		$result9 = array();
		foreach ($tmp9 as $value) {
			$result9[] = $value;
		}
		$this->assertEquals($expected9, $result9);

		/** フレームワークリスト取得テスト */
		$expected10 = array(
			'ASP.NET', 'Struts', 'Spring', 'CakePHP',
			'CodeIgniter', 'FuelPHP', 'Symfony', 'Zend',
			'Ruby on Rails', 'Django', 'Flask'
		);
		$tmp10 = $this->vars['frameworks'];
		$result10 = array();
		foreach ($tmp10 as $value) {
			$result10[] = $value;
		}
		$this->assertEquals($expected10, $result10);

		/** OSリスト取得テスト */
		$expected11 = array(
			'Mac OS X', 'iOS', 'Windows Server 2008', 'Windows 7',
			'Windows 8', 'UNIX', 'Linux', 'Android',
			'Firefox OS'
		);
		$tmp11 = $this->vars['operating_systems'];
		$result11 = array();
		foreach ($tmp11 as $value) {
			$result11[] = $value;
		}
		$this->assertEquals($expected11, $result11);

		/** プログラム言語リスト取得テスト */
		$expected12 = array(
			'Bash', 'C', 'C#', 'C++',
			'CASL', 'COBOL', 'Delphi', 'FORTRAN',
			'Go', 'Haskell', 'Java', 'JavaScript',
			'Objective-C', 'Pascal', 'Perl', 'PHP',
			'PowerShell', 'Python', 'Ruby', 'Scala'
		);
		$tmp12 = $this->vars['programming_languages'];
		$result12 = array();
		foreach ($tmp12 as $value) {
			$result12[] = $value;
		}
		$this->assertEquals($expected12, $result12);

		/** postによるアクセステスト */
		$dataSave = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $dataSave));
		$data3 = array(
			'TechnicalInformations' => array(
				'title' => '',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => ''
			)
		);
		$expected3 = 'POST';
		$this->_testAction('/TechnicalInformations', array('data' => $data3));
		$this->assertEquals($expected3, env('REQUEST_METHOD'));
	
		/** 取得件数のテスト */
		$expected4 = '1';
		$this->assertEquals($expected4, count($this->vars['list']));
}

/**
 * 技術情報照会画面テスト
 */
	public function testView() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$dataSave = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $dataSave));

		/** 照会対象のデータのidを取得 */
		$tmp = $this->TechnicalInformation->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['TechnicalInformation']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/TechnicalInformations/view/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'TechnicalInformation' => array(
				'_id' => $id,
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$result3 = $this->vars['record'];
		unset($result3['TechnicalInformation']['created']);
		unset($result3['TechnicalInformation']['modified']);
		$this->assertEquals($expected3, $result3);

		/** 業種リスト取得テスト */
		$expected8 = array(
			'レンタル', '不動産', '損保', '旅行',
			'物流', '生保', '病院', '官公庁',
			'自動車', '製造', '量販店', '金融', '鉄鋼'
		);
		$tmp8 = $this->vars['business_categories'];
		$result8 = array();
		foreach ($tmp8 as $value) {
			$result8[] = $value;
		}
		$this->assertEquals($expected8, $result8);

		/** DBリスト取得テスト */
		$expected9 = array(
			'H2 Database', 'MongoDB', 'MySQL', 'PostgreSQL',
			'SQLite', 'DB2', 'HiRDB', 'Access',
			'SQL Server', 'Oracle'
		);
		$tmp9 = $this->vars['databases'];
		$result9 = array();
		foreach ($tmp9 as $value) {
			$result9[] = $value;
		}
		$this->assertEquals($expected9, $result9);

		/** フレームワークリスト取得テスト */
		$expected10 = array(
			'ASP.NET', 'Struts', 'Spring', 'CakePHP',
			'CodeIgniter', 'FuelPHP', 'Symfony', 'Zend',
			'Ruby on Rails', 'Django', 'Flask'
		);
		$tmp10 = $this->vars['frameworks'];
		$result10 = array();
		foreach ($tmp10 as $value) {
			$result10[] = $value;
		}
		$this->assertEquals($expected10, $result10);

		/** OSリスト取得テスト */
		$expected11 = array(
			'Mac OS X', 'iOS', 'Windows Server 2008', 'Windows 7',
			'Windows 8', 'UNIX', 'Linux', 'Android',
			'Firefox OS'
		);
		$tmp11 = $this->vars['operating_systems'];
		$result11 = array();
		foreach ($tmp11 as $value) {
			$result11[] = $value;
		}
		$this->assertEquals($expected11, $result11);

		/** プログラム言語リスト取得テスト */
		$expected12 = array(
			'Bash', 'C', 'C#', 'C++',
			'CASL', 'COBOL', 'Delphi', 'FORTRAN',
			'Go', 'Haskell', 'Java', 'JavaScript',
			'Objective-C', 'Pascal', 'Perl', 'PHP',
			'PowerShell', 'Python', 'Ruby', 'Scala'
		);
		$tmp12 = $this->vars['programming_languages'];
		$result12 = array();
		foreach ($tmp12 as $value) {
			$result12[] = $value;
		}
		$this->assertEquals($expected12, $result12);
	}

/**
 * 技術情報編集画面テスト
 */
	public function testEdit() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$dataSave = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $dataSave));

		/** 編集対象のデータのidを取得 */
		$tmp = $this->TechnicalInformation->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['TechnicalInformation']['_id'];

		/** 描画テスト */
		$expected1 = 'html';
		$result1 = $this->_testAction('/TechnicalInformations/edit/' . $id, array('method' => 'get', 'return' => 'contents'));
		$this->assertTextContains($expected1, $result1);

		/** getによるアクセステスト */
		$expected2 = 'GET';
		$this->assertEqual($expected2, env('REQUEST_METHOD'));

		/** get時の取得データテスト */
		$expected3 = array(
			'TechnicalInformation' => array(
				'_id' => $id,
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$result3 = $this->vars['record'];
		unset($result3['TechnicalInformation']['created']);
		unset($result3['TechnicalInformation']['modified']);
		$this->assertEquals($expected3, $result3);

		/** 業種リスト取得テスト */
		$expected8 = array(
			'レンタル', '不動産', '損保', '旅行',
			'物流', '生保', '病院', '官公庁',
			'自動車', '製造', '量販店', '金融', '鉄鋼'
		);
		$tmp8 = $this->vars['business_categories'];
		$result8 = array();
		foreach ($tmp8 as $value) {
			$result8[] = $value;
		}
		$this->assertEquals($expected8, $result8);

		/** DBリスト取得テスト */
		$expected9 = array(
			'H2 Database', 'MongoDB', 'MySQL', 'PostgreSQL',
			'SQLite', 'DB2', 'HiRDB', 'Access',
			'SQL Server', 'Oracle'
		);
		$tmp9 = $this->vars['databases'];
		$result9 = array();
		foreach ($tmp9 as $value) {
			$result9[] = $value;
		}
		$this->assertEquals($expected9, $result9);

		/** フレームワークリスト取得テスト */
		$expected10 = array(
			'ASP.NET', 'Struts', 'Spring', 'CakePHP',
			'CodeIgniter', 'FuelPHP', 'Symfony', 'Zend',
			'Ruby on Rails', 'Django', 'Flask'
		);
		$tmp10 = $this->vars['frameworks'];
		$result10 = array();
		foreach ($tmp10 as $value) {
			$result10[] = $value;
		}
		$this->assertEquals($expected10, $result10);

		/** OSリスト取得テスト */
		$expected11 = array(
			'Mac OS X', 'iOS', 'Windows Server 2008', 'Windows 7',
			'Windows 8', 'UNIX', 'Linux', 'Android',
			'Firefox OS'
		);
		$tmp11 = $this->vars['operating_systems'];
		$result11 = array();
		foreach ($tmp11 as $value) {
			$result11[] = $value;
		}
		$this->assertEquals($expected11, $result11);

		/** プログラム言語リスト取得テスト */
		$expected12 = array(
			'Bash', 'C', 'C#', 'C++',
			'CASL', 'COBOL', 'Delphi', 'FORTRAN',
			'Go', 'Haskell', 'Java', 'JavaScript',
			'Objective-C', 'Pascal', 'Perl', 'PHP',
			'PowerShell', 'Python', 'Ruby', 'Scala'
		);
		$tmp12 = $this->vars['programming_languages'];
		$result12 = array();
		foreach ($tmp12 as $value) {
			$result12[] = $value;
		}
		$this->assertEquals($expected12, $result12);

		/** postによるアクセステスト */
		$data4 = array(
			'TechnicalInformation' => array(
				'id' => $id,
				'title' => 'test2',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$expected4 = 'POST';
		$this->_testAction('/TechnicalInformations/edit/' . $id, array('data' => $data4));
		$this->assertEquals($expected4, env('REQUEST_METHOD'));

		/** 編集されたデータのテスト */
		$expected5 = array(
			'TechnicalInformation' => array(
				'_id' => $id,
				'title' => 'test2',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->TechnicalInformation->id = $id;
		$result5 = $this->TechnicalInformation->read(array('_id','title', 'business_categories', 'databases', 'frameworks', 'operating_systems', 'programming_languages', 'url_evernote', 'url_github', 'detail'));
		unset($result5['TechnicalInformation']['created']);
		unset($result5['TechnicalInformation']['modified']);
		$this->assertEquals($expected5, $result5);

		/** 編集成功時のメッセージのテスト */
		$expected6 = __('編集しました');
		$result6 = CakeSession::read('Message.flash');
		$this->assertEquals($expected6, $result6['message']);

		/** 編集成功時の画面遷移のテスト */
		$expected7 = '/TechnicalInformations';
		$this->assertTextContains($expected7, $this->headers['Location']);

		/** 編集失敗時のテスト */
		CakeSession::destroy();
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$data8 = array(
			'TechnicalInformation' => array(
				'id' => $id,
				'title' => '',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$expected8 = __('編集に失敗しました');
		$this->_testAction('/TechnicalInformations/edit/' . $id, array('data' => $data8));
		$result8 = CakeSession::read('Message.flash');
		$this->assertEquals($expected8, $result8['message']);
	}

/**
 * 技術情報削除処理テスト
 */
	public function testDelete() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$dataSave = array(
			'TechnicalInformation' => array(
				'title' => 'test',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote.com',
				'url_github' => 'http://github.com',
				'detail' => 'test detail',
			)
		);
		$this->_testAction('/TechnicalInformations/add', array('data' => $dataSave));

		/** 編集対象のデータのidを取得 */
		$tmp = $this->TechnicalInformation->find('first', array('fields' => array('_id'), 'order' => array('modified' => 'DESC')));
		$id = $tmp['TechnicalInformation']['_id'];

		/** getによるアクセステスト */
		$this->_testAction('/TechnicalInformations/delete/' . $id, array('method' => 'get'));
		$expected1 = 'GET';
		$this->assertEquals($expected1, env('REQUEST_METHOD'));

		/** データが削除されたかのテスト */
		$expected2 = 0;
		$this->TechnicalInformation->id = $id;
		$result2 = $this->TechnicalInformation->read();
		$this->assertEquals($expected2, count($result2));

		/** 削除成功時のメッセージのテスト */
		$expected3 = __('削除しました');
		$result3 = CakeSession::read('Message.flash');
		$this->assertEquals($expected3, $result3['message']);
	}
}
