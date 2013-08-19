<?php
/**
 * アップファイルコントローラー
 *
 * ファイル情報の検索表示、ファイルダウンロードを行う。
 *
 * @author H.Asakura
 * @version 1.00
 */
class UpfilesController extends AppController {
	/**
	 * 使用するヘルパークラス
	 * @var array
	 * @see AgeHelper
	 */
	public $helpers = array('Age');

	/**
	 * 使用するモデルクラス
	 * @var array
	 */
	public $uses = array('Upfile', 'Patient');

	/**
	 * インデックスアクション
	 *
	 * 患者IDより患者情報とファイル情報の検索取得を行う。
	 *
	 * @param integer $id	患者ID
	 * @return void
	 */
	public function index($id = 0) {
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
	 * ファイルダウンロードアクション
	 *
	 * CakePHPメディアビューを使用したファイルダウンロード処理
	 *
	 * @param integer $id	ファイルID
	 * @return void
	 */
	public function download($id = 0) {
		// idよりファイル情報取得
		$data = $this->Upfile->read(null, $id);
		$fileid = $data['Upfile']['file_address'];
		$filename = $data['Upfile']['upload_name'];

		// 拡張子分離
		$arr = explode('.', $filename);		// 文字列分割
		$ext = array_pop($arr); 			// ファイル拡張子
		$name = implode(".", $arr); 		// ユーザに送信するファイル名

		// メディアビュー
		$this->viewClass = 'Media';
		$params = array(
				'id'        => $fileid,		// ファイル拡張を含むファイルサーバ上のファイル名
				'name'      => $filename,	// ユーザに送信するファイル名
				'download'  => true,		// ダウンロードさせるためにヘッダを送信するかどうかを示すブール値
				'extension' => $ext,		// ファイル拡張子
				'path'      => APP . 'files' . DS,
				'mimeType'  => array('dcm' => 'image/x-dicom'),
		);
		$this->set($params);
	}
}
