<?php

namespace dungphanxuan\vnlocation\helpers;

/**
 * Created by PhpStorm.
 * User: developer
 * Date: 8/15/2017
 * Time: 11:30 AM
 */
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Inflector;


class MapHelper extends Inflector {

	/*
	 * Get Location by address
	 * */
	public static function getLocationbyAddress( $address ) {
		$curl       = new CurlHelper();
		$defaultKey = 'AIzaSyCNmTfwkNfWBggiPp060J19KlvDbDiJUS0';
		$gKey       = isset( Yii::$app->params['gmapApiKey'] ) ? Yii::$app->params['gmapApiKey'] : $defaultKey;
		$url        = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode( $address ) . '&sensor=false&key=' . $gKey;
		$response   = $curl->get( $url );
		$data       = json_decode( $response );

		$item = array();
		if ( $data->status == 'OK' ) {
			$item = $data->results[0]->geometry->location;
		} else {
			Yii::warning( 'Google Map API: Location Not Found!' );
		}

		return $item;
	}
}