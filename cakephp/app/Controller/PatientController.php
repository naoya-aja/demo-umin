<?php
/**
 * 患者情報コントローラー
 *
 * ファイル検索時の患者検索/一覧処理
 *
 * @author H.Asakura
 * @version 1.00
 */
class PatientController extends AppController {
	/**
	 * 使用するモデルクラス
	 * @var array
	 */
	public $uses = array('Patient');

	/**
	 * インデックスアクション
	 *
	 * 患者情報検索/一覧処理
	 *
	 * @return void
	 */
	public function index() {
		// 検索条件が設定されているか？
		if (!empty($this->request->data)) {
			$conds = array();
			$inputData = $this->request->data;

			// 患者ID
			if (strlen($inputData['Patient']['id']) > 0) {
				$conds['id'] = $inputData['Patient']['id'];
			}
			// 姓
			if (strlen($inputData['Patient']['last_name']) > 0) {
				$conds['last_name LIKE'] = $inputData['Patient']['last_name']. '%';
			}
			// 名
			if (strlen($inputData['Patient']['first_name']) > 0) {
				$conds['first_name LIKE'] = $inputData['Patient']['first_name']. '%';
			}
			// 姓かな
			if (strlen($inputData['Patient']['last_name_kana']) > 0) {
				$conds['last_name_kana LIKE'] = $inputData['Patient']['last_name_kana']. '%';
			}
			// 名かな
			if (strlen($inputData['Patient']['first_name_kana']) > 0) {
				$conds['first_name_kana LIKE'] = $inputData['Patient']['first_name_kana']. '%';
			}

			// 検索
			$results = $this->Patient->find('all', array(
				'conditions' => $conds,
			));
			$this->set('patients', $results);
		}
	}
}
