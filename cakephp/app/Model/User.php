<?php
App::uses('AuthComponent', 'Controller/Component');

/**
 * ユーザモデル
 *
 * Authコンポーネント利用
 *
 * @author H.Asakura
 * @version 1.00
 */
class User extends AppModel {
	/**
	 * モデル名
	 * @var string
	 */
	public $name = 'User';

	/**
	 * バリデーション
	 * @var array
	 */
	public $validate = array(
		'password' => array(
			'rule' => array('minLength', '8'),
			'required' => true,
			'message' => 'Mimimum 8 characters long'
		),
	);

	/**
	 * beforeSave処理
	 *
	 * Authコンポーネントにてパスワードの暗号化。
     * データが保存される前に実行される。
	 *
	 * @return boolen true:成功
	 */
	public function beforeSave() {
		// パスワード暗号化
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}
}
