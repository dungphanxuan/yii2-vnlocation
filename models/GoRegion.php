<?php

namespace dungphanxuan\vnlocation\models\go;

use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "go_region".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $image_base_url
 * @property string $image_path
 * @property integer $status
 * @property integer $created_at
 *
 * @property City[] $goCities
 */
class GoRegion extends \yii\db\ActiveRecord {

	public $total_city;
	/**
	 * @var array
	 */
	public $image;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'go_region';
	}

	public function behaviors() {
		return [
			[
				'class'              => TimestampBehavior::className(),
				'createdAtAttribute' => 'created_at',
				'updatedAtAttribute' => 'created_at',
			],
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
			[ [ 'title' ], 'required' ],
			[ [ 'status', 'created_at' ], 'integer' ],
			[ [ 'title', 'slug' ], 'string', 'max' => 32 ],
			[ [ 'image_base_url', 'image_path' ], 'string', 'max' => 255 ],
			[ [ 'image' ], 'safe' ]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'id'             => Yii::t( 'common', 'ID' ),
			'title'          => Yii::t( 'common', 'Title' ),
			'slug'           => Yii::t( 'common', 'Slug' ),
			'image'          => Yii::t( 'common', 'Image' ),
			'image_base_url' => Yii::t( 'common', 'Image Base Url' ),
			'image_path'     => Yii::t( 'common', 'Image Path' ),
			'status'         => Yii::t( 'common', 'Status' ),
			'created_at'     => Yii::t( 'common', 'Created At' ),
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGoCities() {
		return $this->hasMany( City::className(), [ 'region_id' => 'id' ] );
	}

	/*
	* Get total video of category
	* */
	public function getTotal() {
		return $this->hasMany( City::className(), [ 'region_id' => 'id' ] )->count();
	}
}
