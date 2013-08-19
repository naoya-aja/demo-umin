<?php
/**
 * アップファイルコントローラー
 *
 * @author H.Asakura
 */
class UpfilesController extends AppController {
	// 使用するモデルクラス
	public $uses = array('Upfile', 'Patient');

	public $helpers = array('Form', 'UploadPack.Upload');

	function add() {
		if (!empty($this->request->data)) {
//pr($this->request->data);

$this->Upfile->save($this->request->data);

		}
	}

	/**
	 * インデックスアクション
	 *
	 * @param integer $id	患者ID
	 * @return void
	 */
	function index($id = 0) {
		// 患者情報検索
		$patient = $this->Patient->read(null, $id);
		$this->set('patient', $patient);

		// 全件検索
		$upfiles = $this->Upfile->find('all', array(
			'conditions' => array('patient_id' => $id),
		));
		$this->set('upfiles', $upfiles);
	}

	/**
	 * メディアビュー（ファイルダウンロード）
	 *
	 * @param integer $id	ファイルID
	 * @return void
	 */
	function download($id = 0) {
		// idよりファイル情報取得
		$data = $this->Upfile->read(null, $id);

		$filename = $data['Upfile']['upload_name'];
		$fileid = $data['Upfile']['file_address'];
		$path = 'files';
//		$filename = $data['Upfile']['item_file_name'];
//		$settings = UploadBehavior::interpolate('Upfile', $id, 'item', $filename, '', array('app' => '', 'webroot' => ''));
//		$path = $settings['path'];
//
//		// ファイル名分離
//		$arr = explode('/', $path);			// 文字列分割
//		$fileid = array_pop($arr);			// ファイル名
//		if (isset($arr[0]) && strlen($arr[0]) == 0) {
//			array_shift($arr);				// 先頭が空の場合は削除
//		}
//		$path = implode("/", $arr);			// ファイルパス

		// 拡張子分離
		$arr = explode('.', $filename);		// 文字列分割
		$ext = array_pop($arr);				// ファイル拡張子

		// メディアビュー
		$this->viewClass = 'Media';
		$params = array(
				'id'        => $fileid,		// ファイル拡張を含むファイルサーバ上のファイル名
				'name'      => $filename,	// ユーザに送信するファイル名
				'download'  => true,		// ダウンロードさせるためにヘッダを送信するかどうかを示すブール値
				'extension' => $ext,		// ファイル拡張子
				'path'		=> APP. $path . DS,
				'mimeType'  => array('dcm' => 'image/x-dicom'),
		);
		$this->set($params);
	}
}
