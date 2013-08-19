<?php
/**
 * 患者情報登録コントローラー
 *
 * 患者情報の登録、変更。ファイル情報の追加を行う。
 *
 * @version 1.00
 */
class PatientsController extends AppController {
	public $name = 'Patients';
	/**
	 * 使用するヘルパークラス
	 * @var array
	 * @see AgeHelper
	 */
	public $helpers = array('Html', 'Form', 'session', 'Age');

	/**
	 * 使用するモデルクラス
	 * @var array
	 */
	public $uses = array('Upfile', 'Patient', 'Ticket');

	/**
	 * インデックスアクション
	 *
	 * 患者情報を取得し一覧表示する。
	 * @return void
	 */
	public function index() {
		$this->set('patients', $this->Patient->find('all'));
	}

	/**
	 * ファイルインサートアクション
	 *
	 * 新規の患者情報登録を行い患者情報、ファイル情報を追加をする。
	 * @return void
	 */
	public function add() {

		if (!empty($this->request->data)) {
			//患者情報編集
			$this->request->data['Patient']['create_user_id'] = $this->Auth->user('id');
			$this->request->data['Patient']['update_user_id'] = $this->Auth->user('id');

			//患者情報インサート
			if ($this->Patient->save($this->request->data)) {
				//アップロードファイル編集
				$updir = APP . 'files' . DS;
				$this->request->data['Upfile']['file_address'] = basename(tempnam($updir, "D"));
				$upfl = $updir . $this->request->data['Upfile']['file_address'];

				//ファイルアップロード
				if (move_uploaded_file($this->request->data['Upfile']['up_name']['tmp_name'], $upfl)) {
					//ファイル情報編集
					$this->request->data['Upfile']['patient_id'] = $this->Patient->getInsertID();
					$this->request->data['Upfile']['upload_name'] = $this->request->data['Upfile']['up_name']['name'];
					$this->request->data['Upfile']['create_user_id'] = $this->Auth->user('id');
					$this->request->data['Upfile']['update_user_id'] = $this->Auth->user('id');

					//ファイル情報インサート
					if ($this->Upfile->save($this->request->data)) {
						//メッセージとリダイレクト
						$this->Session->setFlash('登録が完了しました。');
						$this->redirect(array('action' => 'index'));
					} else {
						//ファイル情報登録エラー
						$this->Session->setFlash('ファイル情報登録に失敗しました。');
					}
				} else {
					//ファイルアップロードエラー
					$this->Session->setFlash('ファイルアップロードに失敗しました。');
				}
			} else {
				//患者情報登録エラー
				$this->Session->setFlash('患者情報登録に失敗しました。');
			}
		}
	}

	/**
	 * 患者情報エディットアクション
	 *
	 * 登録済の患者情報を修正し、患者情報を更新をする。
	 *
	 * @param integer $id	患者ID
	 * @return void
	 */
	function patientedit($id = null) {
		$this->Patient->id = $id;

		if ($this->request->is('get')) {
			$this->request->data = $this->Patient->read();
		} else {
			//患者情報編集
			$this->request->data['Patient']['update_user_id'] = $this->Auth->user('id');

			//患者情報アップデート
			if ($this->Patient->save($this->request->data)) {
				$this->Session->setFlash('更新が完了しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('更新に失敗しました。');
			}
		}
	}

	/**
	 * ファイル情報インサートアクション
	 *
	 * ファイル情報を修正し、患者情報を更新をする。
	 *
	 * @param integer $id	患者ID
	 * @return void
	 */
	public function fileadd($id = null) {
		if (!empty($this->request->data)) {
			//アップロードファイル編集
			$updir = APP . 'files' . DS;
			$this->request->data['Upfile']['file_address'] = basename(tempnam($updir, "D"));
			$upfl = $updir . $this->request->data['Upfile']['file_address'];

			//ファイルアップロード
			if (move_uploaded_file($this->request->data['Upfile']['up_name']['tmp_name'], $upfl)) {
				//ファイル情報編集
				$this->request->data['Upfile']['patient_id'] = $id;
				$this->request->data['Upfile']['upload_name'] = $this->request->data['Upfile']['up_name']['name'];
				$this->request->data['Upfile']['create_user_id'] = $this->Auth->user('id');
				$this->request->data['Upfile']['update_user_id'] = $this->Auth->user('id');

				//ファイル情報インサート
				if ($this->Upfile->save($this->request->data)) {
					//メッセージとリダイレクト
					$this->Session->setFlash('登録が完了しました。');
					$this->redirect(array('action' => 'index'));
				} else {
					//ファイル情報登録エラー
					$this->Session->setFlash('ファイル情報登録に失敗しました。');
				}
			} else {
				//ファイルアップロードエラー
				$this->Session->setFlash('ファイルアップロードに失敗しました。');
			}
		}
	}

}