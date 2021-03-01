<?php

namespace dungphanxuan\vnlocation\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
class City extends BaseModel
{

    public $total_district;

    /**
     * @var array
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_city';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'name', 'code'], 'required'],
            [['region_id', 'allow', 'priority', 'status', 'created_at', 'updated_at'], 'integer'],
            [['lat', 'lng'], 'number'],
            [
                ['name', 'slug', 'short_name', 'code', 'code_ghn', 'code_vtp', 'code_njv', 'code_kerry'],
                'string',
                'max' => 32
            ],
            [['image_base_url', 'image_path'], 'string', 'max' => 255],
            [
                ['region_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => GoRegion::className(),
                'targetAttribute' => ['region_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Region',
            'name' => 'Tên tỉnh/thành phố',
            'slug' => 'Slug',
            'short_name' => 'Short Name',
            'code' => 'Code',
            'code_ghn' => 'Code Ghn',
            'code_vtp' => 'Code Vtp',
            'code_njv' => 'Code Njv',
            'code_kerry' => 'Code Kerry',
            'allow' => 'Allow',
            'priority' => 'Priority',
            'image' => 'Image',
            'image_base_url' => 'Image Base Url',
            'image_path' => 'Image Path',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(GoRegion::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoDistricts()
    {
        return $this->hasMany(District::className(), ['city_id' => 'id']);
    }

    public static function getCities($region_id)
    {
        $dataModel = City::find()
            ->where(['region_id' => $region_id])
            ->asArray()
            ->all();
        $data = \yii\helpers\ArrayHelper::map($dataModel, 'id', 'name');

        return $data;
    }

    /*
    * Get total video of category
    * */
    public function getTotal()
    {
        return $this->hasMany(District::className(), ['city_id' => 'id'])->count();
    }

    public static function getList()
    {
        $allData = City::find()
            ->orderBy('priority desc')
            ->all();
        $dataItem = ArrayHelper::map($allData, 'id', 'name');

        return $dataItem;
    }
}
