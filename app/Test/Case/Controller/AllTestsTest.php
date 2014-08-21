<?php
/**
 * All Test Suite
 * 
 * @package app.Test.Case.Controller
 * @author Koichi Ezato <koichi-ezato@osc-corp.co.jp>
 */
class AllTestsTest extends CakeTestSuite {

	public static function suite() {
		$suite = new CakeTestSuite('All tests');
		$suite->addTestDirectoryRecursive(TESTS . 'Case/Model');
		$suite->addTestDirectoryRecursive(TESTS . 'Case/Controller');
		return $suite;
	}
}
