<?php
/**
 * ユーザコントローラー
 *
 * Authコンポーネントを使用したログイン処理。
 *
 * @author H.Asakura
 * @version 1.00
 */
class UsersController extends AppController {

	/**
	 * ログイン処理アクション
	 *
	 * ログアウト処理後、ログイン情報があればログイン処理を行う。
	 *
	 * @return void
	 */
	public function login() {
		// ログイン画面表示でログアウトする
		$this->Auth->logout();

		if ($this->request->is('post')) {
			// ログイン処理
			if ($this->Auth->login()) {
				// 成功
				$this->redirect($this->Auth->redirect());
			} else {
				// 失敗
				$this->Session->setFlash('Your username or password was incorrect.');
			}
		}
	}

	/**
	 * ログアウト処理アクション
	 *
	 * ログアウト処理後、ログアウト後パスへ遷移する。
	 *
	 * @return void
	 */
	public function logout() {
		// ログアウト処理
		$this->Auth->logout();

		// ログアウト時に遷移するパスへ遷移
		$this->redirect($this->Auth->logoutRedirect);
	}

	/**
	 * パスワード変更アクション
	 *
	 * ログインユーザのパスワード変更処理。
	 *
	 * @return void
	 */
	public function editPasswd() {
		if ($this->request->is('post')) {

			// 保存データ
			$data['User'] = array(
				'id' => $this->Auth->User('id'),
				'password' => $this->request->data['User']['password'],
			);

			// データ保存
			if ($this->User->save($data)) {
				// パスワード変更の処理、成功したらログアウト
				$this->Session->setFlash('パスワードを変更しました。ログインし直してください。');

				// ログアウト処理
				$this->redirect('logout');
			}
		}
	}

	/**
	 * メニューアクション
	 *
	 * メニュー表示。テンプレート表示のみのため処理なし。
	 *
	 * @return void
	 */
	public function menu() {
		// 処理なし
	}
}
