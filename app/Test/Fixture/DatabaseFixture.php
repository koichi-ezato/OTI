<?php

/**
 * Database Fixture
 */
class DatabaseFixture extends CakeTestFixture {

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
		array('name' => 'H2 Database'),
		array('name' => 'MongoDB'),
		array('name' => 'MySQL'),
		array('name' => 'PostgreSQL'),
		array('name' => 'SQLite'),
		array('name' => 'DB2'),
		array('name' => 'HiRDB'),
		array('name' => 'Access'),
		array('name' => 'SQL Server'),
		array('name' => 'Oracle'),
	);
}
