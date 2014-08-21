<?php
App::uses('TechnicalInformation', 'Model');
APP::uses('AuthComponent', 'Controller/Component');

/**
 * TechnicalInformation Test Case
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
class TechnicalInformationTest extends CakeTestCase {

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
 * 技術情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array(
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
		$data1 = array(
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
		$this->TechnicalInformation->save($data1);
		$lastId = $this->TechnicalInformation->getLastInsertID();
		$this->TechnicalInformation->id = $lastId;
		$result1 = $this->TechnicalInformation->read(array('title', 'business_categories', 'databases', 'frameworks', 'operating_systems', 'programming_languages', 'url_evernote', 'url_github', 'detail'));
		unset($result1['TechnicalInformation']['_id']);
		$this->assertEqual($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array(
			'TechnicalInformation' => array(
				'_id' => $lastId,
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
		$result2 = $this->TechnicalInformation->getRecord($lastId);
		unset($result2['TechnicalInformation']['created']);
		unset($result2['TechnicalInformation']['modified']);
		$this->assertEqual($expected2, $result2);

		/** updateテスト */
		$expected3 = array(
			'TechnicalInformation' => array(
				'title' => 'test2',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote2.com',
				'url_github' => 'http://github2.com',
				'detail' => 'test detail2',
			)
		);
		$data3 = array(
			'TechnicalInformation' => array(
				'title' => 'test2',
				'business_categories' => '',
				'databases' => '',
				'frameworks' => '',
				'operating_systems' => '',
				'programming_languages' => '',
				'url_evernote' => 'http://evernote2.com',
				'url_github' => 'http://github2.com',
				'detail' => 'test detail2',
			)
		);
		$this->TechnicalInformation->id = $lastId;
		$this->TechnicalInformation->save($data3);
		$result3 = $this->TechnicalInformation->read(array('title', 'business_categories', 'databases', 'frameworks', 'operating_systems', 'programming_languages', 'url_evernote', 'url_github', 'detail'));
		unset($result3['TechnicalInformation']['_id']);
		$this->assertEquals($expected3, $result3);

		/** データ取得時のテスト */
		$data4 = array(
			'title' => '',
			'business_categories' => '',
			'databases' => '',
			'frameworks' => '',
			'operating_systems' => '',
			'programming_languages' => ''
		);
		$tmp4 = $this->TechnicalInformation->getList($data4);

		$expected4 = true;
		$result4 = true;
		foreach ($tmp4 as $value) {
			if (!array_key_exists('_id', $value['TechnicalInformation'])) {
				$result4 = false;
				break;
			}
		}
		$this->assertEquals($expected4, $result4);

		$expected5 = array(
			array(
				'TechnicalInformation' => array(
					'title' => 'test2',
					'business_categories' => '',
					'databases' => '',
					'frameworks' => '',
					'operating_systems' => '',
					'programming_languages' => '',
					'url_evernote' => 'http://evernote2.com',
					'url_github' => 'http://github2.com',
					'detail' => 'test detail2',
				)
			)
		);
		$result5 = array();
		foreach ($tmp4 as $value) {
			unset($value['TechnicalInformation']['_id']);
			unset($value['TechnicalInformation']['created']);
			unset($value['TechnicalInformation']['modified']);
			$result5[] = $value;
		}
		$this->assertEquals($expected5, $result5);

		$data6 = array(
			'title' => 'test',
			'business_categories' => '',
			'databases' => '',
			'frameworks' => '',
			'operating_systems' => '',
			'programming_languages' => ''
		);
		$tmp6 = $this->TechnicalInformation->getList($data6);
		$expected6 = array(
			array(
				'TechnicalInformation' => array(
					'title' => 'test2',
					'business_categories' => '',
					'databases' => '',
					'frameworks' => '',
					'operating_systems' => '',
					'programming_languages' => '',
					'url_evernote' => 'http://evernote2.com',
					'url_github' => 'http://github2.com',
					'detail' => 'test detail2',
				)
			)
		);
		$result6 = array();
		foreach ($tmp6 as $value) {
			unset($value['TechnicalInformation']['_id']);
			unset($value['TechnicalInformation']['created']);
			unset($value['TechnicalInformation']['modified']);
			$result6[] = $value;
		}
		$this->assertEquals($expected6, $result6);

		$data7 = array(
			'title' => 'test',
			'business_categories' => array('1'),
			'databases' => array('2'),
			'frameworks' => array('3'),
			'operating_systems' => array('4'),
			'programming_languages' => array('5')
		);
		$tmp7 = $this->TechnicalInformation->getList($data7);
		$expected7 = array();
		$result7 = array();
		foreach ($tmp7 as $value) {
			unset($value['TechnicalInformation']['_id']);
			unset($value['TechnicalInformation']['created']);
			unset($value['TechnicalInformation']['modified']);
			$result7[] = $value;
		}
		$this->assertEquals($expected7, $result7);
	}

/**
 * バリデーションチェック(false)
 */
	public function testValidationFalse() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array(
			array('title' => array('タイトルは必ず入力してください')),
			array('detail' => array('詳細は必ず入力してください')),
			array('url_evernote' => array('URLが不正です')),
			array('url_github' => array('URLが不正です')),
		);
		$data = array(
			array('TechnicalInformation' => array('title' => null, 'detail' => 'test', 'url_evernote' => null, 'url_github' => null)),
			array('TechnicalInformation' => array('title' => 'test', 'detail' => null, 'url_evernote' => null, 'url_github' => null)),
			array('TechnicalInformation' => array('title' => 'test', 'detail' => 'test', 'url_evernote' => 'test', 'url_github' => null)),
			array('TechnicalInformation' => array('title' => 'test', 'detail' => 'test', 'url_evernote' => null, 'url_github' => 'test')),
		);
		$this->TechnicalInformation->saveAll($data);
		$this->assertEquals($expected, $this->TechnicalInformation->validationErrors);
	}


/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('TechnicalInformation' => array('title' => 'test', 'detail' => 'test', 'url_evernote' => null, 'url_github' => null)),		);
		$this->TechnicalInformation->saveAll($data);
		$this->assertEquals($expected, $this->TechnicalInformation->validationErrors);
	}
}
