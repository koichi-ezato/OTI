<?php

/**
 * Framework Fixture
 */
class FrameworkFixture extends CakeTestFixture {

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
		array('name' => 'ASP.NET'),
		array('name' => 'Struts'),
		array('name' => 'Spring'),
		array('name' => 'CakePHP'),
		array('name' => 'CodeIgniter'),
		array('name' => 'FuelPHP'),
		array('name' => 'Symfony'),
		array('name' => 'Zend'),
		array('name' => 'Ruby on Rails'),
		array('name' => 'Django'),
		array('name' => 'Flask'),
	);
}
