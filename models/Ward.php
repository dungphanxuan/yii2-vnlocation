<?php

namespace dungphanxuan\vnlocation\models;

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
			TimestampBehavior::className()
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
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'             => 'ID',
			'region_id'      => 'Region',
			'city_id'        => 'City',
			'district_id'    => 'District',
			'name'           => 'Ward Name',
			'slug'           => 'Slug',
			'fullname'       => 'Fullname',
			'short_name'     => 'Short Name',
			'code_vtp'       => 'Code Vtp',
			'code_spl'       => 'Code Spl',
			'priority'       => 'Priority',
			'image_base_url' => 'Image Base Url',
			'image_path'     => 'Image Path',
			'lat'            => 'Lat',
			'lng'            => 'Lng',
			'status'         => 'Status',
			'created_at'     => 'Created At',
			'updated_at'     => 'Updated At',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict() {
		return $this->hasOne( District::className(), [ 'id' => 'district_id' ] );
	}
}
