<?php
/**
 * アプリケーション基本コントローラークラス
 *
 * 各コントローラーの共通処理
 *
 * @author H.Asakura
 * @version 1.00
 */
class AppController extends Controller {
	/**
	 * 使用するコンポーネントクラス
	 * @var array
	 */
	public $components = array('Auth', 'Session');

	/**
	 * 使用するヘルパークラス
	 * @var array
	 */
	public $helpers = array('Html', 'Form', 'Session');

	/**
	 * beforeFilter処理
	 *
	 * コントローラー処理開始前のコールバック処理
	 *
	 * @return void
	 */
	public function beforeFilter() {
		// Configure AuthComponent
		// ログイン画面のあるパス
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');

		// ログアウト時に遷移するパス
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');

		// ログイン時に遷移するパス
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'menu');

		if (!empty($this->request->data)) {
			$logdata = 'userID:' . $this->Auth->user('username') . ' ' .
					   'controller:' . $this->name . ' ' .
					   'action:' . $this->action . ' ' .
					   'data:';
			$logdata .= print_r($this->request->data, true);
			$this->log($logdata, 'trace');
		} else {
			$logdata = 'userID:' . $this->Auth->user('username') . ' ' .
					   'controller:' . $this->name . ' ' .
					   'action:' . $this->action;
			$this->log($logdata, 'trace');
		}
	}
}
