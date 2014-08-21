<?php

/**
 * TechnicalInformation Fixture
 */
class TechnicalInformationFixture extends CakeTestFixture {

/**
 * Fields
 * @var array
 */
	public $fields = array(
		'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'タイトル', 'charset' => 'utf8'),
		'business_categories' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '業種', 'charset' => 'utf8'),
		'databases' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'DB', 'charset' => 'utf8'),
		'frameworks' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'フレームワーク', 'charset' => 'utf8'),
		'operating_systems' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'OS', 'charset' => 'utf8'),
		'programming_languages' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'プログラム言語', 'charset' => 'utf8'),
		'url_evernote' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Evernote URL', 'charset' => 'utf8'),
		'url_github' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'GitHub URL', 'charset' => 'utf8'),
		'detail' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '詳細', 'charset' => 'utf8'),
	);
}
