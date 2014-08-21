<?php
App::uses('ProgrammingLanguage', 'Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * ProgrammingLanguage Test Case
 * 
 * @package			app.Test.Case.Model
 * @author			Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 * 
 * @property ProgrammingLanguage $ProgrammingLanguage プログラム言語マスタ
 */
class ProgrammingLanguageTest extends CakeTestCase {

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
 * プログラム言語情報保存テスト
 */
	public function testAll() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		/** Insertテスト */
		$expected1 = array('ProgrammingLanguage' => array('name' => 'PHP'));
		$data1 = array('ProgrammingLanguage' => array('name' => 'PHP'));
		$this->ProgrammingLanguage->save($data1);
		$lastId = $this->ProgrammingLanguage->getLastInsertID();
		$this->ProgrammingLanguage->id = $lastId;
		$result1 = $this->ProgrammingLanguage->read(array('name'));
		unset($result1['ProgrammingLanguage']['_id']);
		$this->assertEquals($expected1, $result1);

		/** データ1件取得時のテスト */
		$expected2 = array('ProgrammingLanguage' => array('_id' => $lastId, 'name' => 'PHP'));
		$result2 = $this->ProgrammingLanguage->getRecord($lastId);
		unset($result2['ProgrammingLanguage']['modified']);
		unset($result2['ProgrammingLanguage']['created']);
		$this->assertEquals($expected2, $result2);

		/** updateテスト */
		$expected3 = array('ProgrammingLanguage' => array('name' => 'PHP2'));
		$data2 = array('ProgrammingLanguage' => array('name' => 'PHP2'));
		$this->ProgrammingLanguage->id = $lastId;
		$this->ProgrammingLanguage->save($data2);
		$result3 = $this->ProgrammingLanguage->read(array('name'));
		unset($result3['ProgrammingLanguage']['_id']);
		$this->assertEquals($expected3, $result3);
	}

/**
 * プログラム言語情報取得テスト
 */
	public function testGetList() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));

		$data1 = array(
			'name' => ''
		);
		$tmp1 = $this->ProgrammingLanguage->getList($data1);

		$expected1 = true;
		$result1 = true;
		foreach ($tmp1 as $value) {
			if (!array_key_exists('_id', $value['ProgrammingLanguage'])) {
				$result1 = false;
				break;
			}
		}
		$this->assertEquals($expected1, $result1);

		$expected2 = array(
			array('ProgrammingLanguage' => array('name' => 'Bash')),
			array('ProgrammingLanguage' => array('name' => 'C')),
			array('ProgrammingLanguage' => array('name' => 'C#')),
			array('ProgrammingLanguage' => array('name' => 'C++')),
			array('ProgrammingLanguage' => array('name' => 'CASL')),
			array('ProgrammingLanguage' => array('name' => 'COBOL')),
			array('ProgrammingLanguage' => array('name' => 'Delphi')),
			array('ProgrammingLanguage' => array('name' => 'FORTRAN')),
			array('ProgrammingLanguage' => array('name' => 'Go')),
			array('ProgrammingLanguage' => array('name' => 'Haskell')),
			array('ProgrammingLanguage' => array('name' => 'Java')),
			array('ProgrammingLanguage' => array('name' => 'JavaScript')),
			array('ProgrammingLanguage' => array('name' => 'Objective-C')),
			array('ProgrammingLanguage' => array('name' => 'Pascal')),
			array('ProgrammingLanguage' => array('name' => 'Perl')),
			array('ProgrammingLanguage' => array('name' => 'PHP')),
			array('ProgrammingLanguage' => array('name' => 'PowerShell')),
			array('ProgrammingLanguage' => array('name' => 'Python')),
			array('ProgrammingLanguage' => array('name' => 'Ruby')),
			array('ProgrammingLanguage' => array('name' => 'Scala')),
		);
		$result2 = array();
		foreach ($tmp1 as $value) {
			unset($value['ProgrammingLanguage']['_id']);
			$result2[] = $value;
		}
		$this->assertEquals($expected2, $result2);

		$data3 = array(
			'name' => 'PHP'
		);
		$tmp3 = $this->ProgrammingLanguage->getList($data3);
		$expected3 = array(
			array('ProgrammingLanguage' => array('name' => 'PHP')),
		);
		$result3 = array();
		foreach ($tmp3 as $value) {
			unset($value['ProgrammingLanguage']['_id']);
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
			array('ProgrammingLanguage' => array('name' => null))
		);
		$this->ProgrammingLanguage->saveAll($data);
		$this->assertEquals($expected, $this->ProgrammingLanguage->validationErrors);
	}

/**
 * バリデーションチェック(true)
 */
	public function testValidationTrue() {
		CakeSession::write('Auth.User', array('_id' => '53ec27ef0f153a5e6eb7acd9', 'username' => '53'));
		$expected = array();
		$data = array(
			array('ProgrammingLanguage' => array('name' => 'test'))
		);
		$this->ProgrammingLanguage->saveAll($data);
		$this->assertEquals($expected, $this->ProgrammingLanguage->validationErrors);
	}
}
