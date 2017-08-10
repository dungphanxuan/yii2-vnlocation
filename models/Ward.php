<?php

namespace dungphanxuan\vnlocation\models\go;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "go_ward".
 *
 * @property integer $id
 * @property integer $district_id
 * @property string $name
 * @property string $slug
 * @property string $fullname
 * @property string $short_name
 * @property string $code_vtp
 * @property string $code_spl
 * @property integer $priority
 * @property string $image_base_url
 * @property string $image_path
 * @property double $lat
 * @property double $lng
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property District $district
 */
class Ward extends \yii\db\ActiveRecord {

	public $region_id;

	public $city_id;
	/**
	 * @var array
	 */
	public $image;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'go_ward';
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
			[ [ 'district_id', 'name' ], 'required' ],
			[ [ 'district_id', 'priority', 'status', 'created_at', 'updated_at' ], 'integer' ],
			[ [ 'lat', 'lng' ], 'number' ],
			[ [ 'code_vtp', 'code_spl' ], 'string', 'max' => 32 ],
			[ [ 'slug', 'fullname', 'name' ], 'string', 'max' => 128 ],
			[ [ 'short_name' ], 'string', 'max' => 64 ],
			[ [ 'image_base_url', 'image_path' ], 'string', 'max' => 255 ],
			[
				[ 'district_id' ],
				'exist',
				'skipOnError'     => true,
				'targetClass'     => District::className(),
				'targetAttribute' => [ 'district_id' => 'id' ]
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
			'district_id'    => Yii::t( 'common', 'District' ),
			'name'           => Yii::t( 'common', 'Ward Name' ),
			'slug'           => Yii::t( 'common', 'Slug' ),
			'fullname'       => Yii::t( 'common', 'Fullname' ),
			'short_name'     => Yii::t( 'common', 'Short Name' ),
			'code_vtp'       => Yii::t( 'common', 'Code Vtp' ),
			'code_spl'       => Yii::t( 'common', 'Code Spl' ),
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
	public function getDistrict() {
		return $this->hasOne( District::className(), [ 'id' => 'district_id' ] );
	}
}
