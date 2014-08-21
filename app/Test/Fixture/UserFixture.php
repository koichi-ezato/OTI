<?php

/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 * 
 * @var array
 */
	public $fields = array(
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '社員番号', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'パスワード', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '氏名', 'charset' => 'utf8')
	);

/**
 * Records
 * 
 * @var array
 */
	public $records = array(
		array(
			'username' => '53',
			'password' => '78271e33a60fa14a801dcd7b09f540ffce4c150b',
			'name' => '江里　晃一'
		)
	);
}
