<?php

namespace dungphanxuan\vnlocation\models\go;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "go_district".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property string $slug
 * @property string $full_name
 * @property string $short_name
 * @property string $code
 * @property string $code_ghn
 * @property string $code_vtp
 * @property string $code_kerry
 * @property string $code_spl
 * @property integer $kind_from
 * @property integer $kind_to
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
 * @property City $city
 * @property Ward[] $goWards
 */
class District extends \yii\db\ActiveRecord {

	/**
	 * @var array
	 */
	public $image;

	public $region_id;
	public $total_ward;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'go_district';
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
			[ [ 'city_id', 'name', 'code' ], 'required' ],
			[
				[ 'city_id', 'kind_from', 'kind_to', 'allow', 'priority', 'status', 'created_at', 'updated_at' ],
				'integer'
			],
			[ [ 'lat', 'lng' ], 'number' ],
			[
				[ 'name', 'slug', 'short_name', 'code', 'code_ghn', 'code_vtp', 'code_kerry' ],
				'string',
				'max' => 32
			],
			[ [ 'code_spl', 'full_name' ], 'string', 'max' => 64 ],
			[ [ 'image_base_url', 'image_path' ], 'string', 'max' => 255 ],
			[
				[ 'city_id' ],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => City::className(),
				'targetAttribute' => [ 'city_id' => 'id' ]
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
			'city_id'        => Yii::t( 'common', 'City' ),
			'name'           => Yii::t( 'common', 'District Name' ),
			'slug'           => Yii::t( 'common', 'Slug' ),
			'full_name'      => Yii::t( 'common', 'Full Name' ),
			'short_name'     => Yii::t( 'common', 'Short Name' ),
			'code'           => Yii::t( 'common', 'Code' ),
			'code_ghn'       => Yii::t( 'common', 'Code Ghn' ),
			'code_vtp'       => Yii::t( 'common', 'Code Vtp' ),
			'code_kerry'     => Yii::t( 'common', 'Code Kerry' ),
			'code_spl'       => Yii::t( 'common', 'Code Spl' ),
			'kind_from'      => Yii::t( 'common', 'Kind From' ),
			'kind_to'        => Yii::t( 'common', 'Kind To' ),
			'allow'          => Yii::t( 'common', 'Allow' ),
			'priority'       => Yii::t( 'common', 'Priority' ),
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
	public function getCity() {
		return $this->hasOne( City::className(), [ 'id' => 'city_id' ] );
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGoWards() {
		return $this->hasMany( Ward::className(), [ 'district_id' => 'id' ] );
	}

	public static function getDistricts( $city_id ) {
		$dataModel = District::find()
		                 ->where( [ 'city_id' => $city_id ] )
		                 ->asArray()
		                 ->all();
		$data      = ArrayHelper::map( $dataModel, 'id', 'name' );

		return $data;
	}

	/*
	* Get total video of category
	* */
	public function getTotal() {
		return $this->hasMany( Ward::className(), [ 'district_id' => 'id' ] )->count();
	}
}
