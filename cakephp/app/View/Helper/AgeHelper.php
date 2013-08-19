<?php
/**
 * 年齢算出ヘルパ
 *
 * @version 1.00
 */
class AgeHelper extends Helper {

	/**
	 * 今日時点での年齢を誕生日から算出する。
	 * @param date $birthday	生年月日
	 * @return void
	 */
	function ageconv($birthday) {
		//yyyy-mm-dd → yyyymmdd にフォーマット変更
		$birthday = date('Ymd', strtotime($birthday));
		$today = date('Ymd');

		//本日日付と生年月日の差を算出
		$difference = (string)($today - $birthday);

		//サプレスされた0を補充
		while (strlen($difference) < 8) {
			$difference = '0' . $difference;
		}

		//１～４バイト（年）が年齢
		$age_y = (int)(substr($difference, 0, 4));
		//５～６バイト（月）が月数
		$age_m = (int)(substr($difference, 4, 2));
		//今年の誕生日未到来の場合
		if ($age_m > 12) {
			//誕生日までの月数を算出し現在何ヶ月かを求める
			$age_m = (12 - (100 - $age_m));
		}
		return $age_y . '歳' . $age_m . 'ヶ月';
	}
}
