<?php

/**
 * OperatingSystem Fixture
 */
class OperatingSystemFixture extends CakeTestFixture {

/**
 * Fields
 * 
 * @var array
 */
	public $fields = array(
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '氏名', 'charset' => 'utf8')
	);

/**
 * Records
 * 
 * @var array
 */
	public $records = array(
		array('name' => 'Mac OS X'),
		array('name' => 'iOS'),
		array('name' => 'Windows Server 2008'),
		array('name' => 'Windows 7'),
		array('name' => 'Windows 8'),
		array('name' => 'UNIX'),
		array('name' => 'Linux'),
		array('name' => 'Android'),
		array('name' => 'Firefox OS'),
	);
}
