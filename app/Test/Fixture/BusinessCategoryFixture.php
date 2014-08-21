<?php

/**
 * BusinessCategory Fixture
 */
class BusinessCategoryFixture extends CakeTestFixture {

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
		array('name' => 'レンタル'),
		array('name' => '不動産'),
		array('name' => '損保'),
		array('name' => '旅行'),
		array('name' => '物流'),
		array('name' => '生保'),
		array('name' => '病院'),
		array('name' => '官公庁'),
		array('name' => '自動車'),
		array('name' => '製造'),
		array('name' => '量販店'),
		array('name' => '金融'),
		array('name' => '鉄鋼'),
	);
}
