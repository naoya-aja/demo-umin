<?php
/**
 * 患者情報ファイルモデル
 *
 * アップロードファイル情報
 *
 * @version 1.00
 */
class Patient extends AppModel {
	/**
	 * モデル名
	 * @var string
	 */
	public $name = 'Patient';

	/**
	 * 入力チェック
	 * @var array
	 */
	public $validate = array(
		'last_name' => array(
			'rule' => 'notEmpty'
	),
		'first_name' => array(
			'rule' => 'notEmpty'
	),
		'first_name_kana' => array(
			'rule' => 'notEmpty'
	),
		'first_name_kana' => array(
			'rule' => 'notEmpty'
	)
	);

}