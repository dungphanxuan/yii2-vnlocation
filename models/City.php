<?php

namespace dungphanxuan\vnlocation\models\go;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "go_city".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $name
 * @property string $slug
 * @property string $short_name
 * @property string $code
 * @property string $code_ghn
 * @property string $code_vtp
 * @property string $code_njv
 * @property string $code_kerry
 * @property integer $allow
 * @property integer $priority
 * @property string $image_base_url
 * @property string $image_path
 * @property double $lat
 * @property double $lng
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property GoRegion $region
 * @property District[] $goDistricts
 */
class City extends \yii\db\ActiveRecord {

	public $total_district;

	/**
	 * @var array
	 */
	public $image;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'go_city';
	}

	public function behaviors() {
		return [
			TimestampBehavior::className(),
			[
				'class'            => UploadBehavior::className(),
				'attribute'        => 'image',
				'pathAttribute'    => 'image_path',
				'baseUrlAttribute' => 'image_base_url'
			]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[ [ 'region_id', 'name', 'code' ], 'required' ],
			[ [ 'region_id', 'allow', 'priority', 'status', 'created_at', 'updated_at' ], 'integer' ],
			[ [ 'lat', 'lng' ], 'number' ],
			[
				[ 'name', 'slug', 'short_name', 'code', 'code_ghn', 'code_vtp', 'code_njv', 'code_kerry' ],
				'string',
				'max' => 32
			],
			[ [ 'image_base_url', 'image_path' ], 'string', 'max' => 255 ],
			[
				[ 'region_id' ],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => GoRegion::className(),
				'targetAttribute' => [ 'region_id' => 'id' ]
			],
			[ [ 'image' ], 'safe' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'             => Yii::t( 'common', 'ID' ),
			'region_id'      => Yii::t( 'common', 'Region' ),
			'name'           => Yii::t( 'common', 'Tên tỉnh/thành phố' ),
			'slug'           => Yii::t( 'common', 'Slug' ),
			'short_name'     => Yii::t( 'common', 'Short Name' ),
			'code'           => Yii::t( 'common', 'Code' ),
			'code_ghn'       => Yii::t( 'common', 'Code Ghn' ),
			'code_vtp'       => Yii::t( 'common', 'Code Vtp' ),
			'code_njv'       => Yii::t( 'common', 'Code Njv' ),
			'code_kerry'     => Yii::t( 'common', 'Code Kerry' ),
			'allow'          => Yii::t( 'common', 'Allow' ),
			'priority'       => Yii::t( 'common', 'Priority' ),
			'image'          => Yii::t( 'common', 'Image' ),
			'image_base_url' => Yii::t( 'common', 'Image Base Url' ),
			'image_path'     => Yii::t( 'common', 'Image Path' ),
			'lat'            => Yii::t( 'common', 'Lat' ),
			'lng'            => Yii::t( 'common', 'Lng' ),
			'status'         => Yii::t( 'common', 'Status' ),
			'created_at'     => Yii::t( 'common', 'Created At' ),
			'updated_at'     => Yii::t( 'common', 'Updated At' ),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRegion() {
		return $this->hasOne( GoRegion::className(), [ 'id' => 'region_id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGoDistricts() {
		return $this->hasMany( District::className(), [ 'city_id' => 'id' ] );
	}

	public static function getCities( $region_id ) {
		$dataModel = City::find()
		                 ->where( [ 'region_id' => $region_id ] )
		                 ->asArray()
		                 ->all();
		$data      = \yii\helpers\ArrayHelper::map( $dataModel, 'id', 'name' );

		return $data;
	}

	/*
	* Get total video of category
	* */
	public function getTotal() {
		return $this->hasMany( District::className(), [ 'city_id' => 'id' ] )->count();
	}

}
