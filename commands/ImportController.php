<?php
/**
 * Created by PhpStorm.
 * User: dungpx
 * Date: 8/10/2017
 * Time: 5:09 PM
 */

namespace dungphanxuan\vnlocation\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use yii\helpers\Inflector;
use dungphanxuan\vnlocation\models\City;
use dungphanxuan\vnlocation\models\District;
use dungphanxuan\vnlocation\models\Ward;


class ImportController extends Controller {

	/**
	 * This command will import location data from json file
	 */
	public function actionIndex() {
		$this->stdout( 'Start Import' . "!\n" );
		$this->runAction( 'city' );
		$this->runAction( 'district' );
		$this->runAction( 'ward' );
		$this->stdout( 'Import Done!' );
	}

	public function actionCity() {
		$this->stdout( 'Start Import City' . "!\n", Console::FG_GREEN );
		$jsonfile = Yii::getAlias( '@vendor/dungphanxuan/yii2-vnlocation/datas/cities.json' );
		$fp       = fopen( $jsonfile, 'r' );
		$data     = fread( $fp, filesize( $jsonfile ) );
		fclose( $fp );
		$data                        = json_decode( $data );
		$dataAll                     = $data->data;

		foreach ( $dataAll as $item ) {
			$dataInser = (array) $item;
			unset( $dataInser['deleted_at'] );
			unset( $dataInser['created_at'] );
			$dataInser['slug']       = Inflector::slug( $dataInser['name'] );
			$dataInser['created_at'] = time();
			$dataInser['updated_at'] = time();
			Yii::$app->db->createCommand()->insert( City::getTableSchema()->name, $dataInser )->execute();
		}

		$this->stdout( 'Done Import City' . "!\n", Console::FG_GREEN );
	}

	public function actionDistrict() {
		$this->stdout( 'Start Import District' . "!\n", Console::FG_GREEN );
		$jsonfile = Yii::getAlias( '@vendor/dungphanxuan/yii2-vnlocation/datas/districts.json' );
		$fp       = fopen( $jsonfile, 'r' );
		$data     = fread( $fp, filesize( $jsonfile ) );
		fclose( $fp );
		$data                        = json_decode( $data );
		$dataAll                     = $data->data;

		foreach ( $dataAll as $item ) {
			$dataInser = (array) $item;

			unset( $dataInser['kind_from_txt'] );
			unset( $dataInser['kind_to_txt'] );
			unset( $dataInser['deleted_at'] );
			unset( $dataInser['created_at'] );
			$dataInser['slug']       = Inflector::slug( $dataInser['name'] );
			$dataInser['full_name']  = $dataInser['fullname'];
			$dataInser['created_at'] = time();
			$dataInser['updated_at'] = time();
			unset( $dataInser['fullname'] );
			unset( $dataInser['city_code'] );
			Yii::$app->db->createCommand()->insert( District::getTableSchema()->name, $dataInser )->execute();
		}

		$this->stdout( 'Done Import District' . "!\n", Console::FG_GREEN );
	}

	/*
	 * */
	public function actionWard() {
		$this->stdout( 'Start Import Ward' . "!\n", Console::FG_GREEN );
		$jsonfile = Yii::getAlias( '@vendor/dungphanxuan/yii2-vnlocation/datas/wards.json' );
		$fp       = fopen( $jsonfile, 'r' );
		$data     = fread( $fp, filesize( $jsonfile ) );
		fclose( $fp );
		$data                        = json_decode( $data );
		$dataAll                     = $data->data;

		foreach ( $dataAll as $item ) {
			$dataInser = (array) $item;
			unset( $dataInser['deleted_at'] );
			unset( $dataInser['created_at'] );
			unset( $dataInser['district_code'] );
			$dataInser['slug']       = Inflector::slug( $dataInser['name'] );
			$dataInser['created_at'] = time();
			$dataInser['updated_at'] = time();

			$model = Ward::find()->where( [ 'id' => $dataInser['id'] ] )->one();

			if ( ! $model ) {
				Yii::$app->db->createCommand()->insert( Ward::getTableSchema()->name, $dataInser )->execute();
			}
		}

		$this->stdout( 'Done Import Ward' . "!\n", Console::FG_GREEN );
	}

}