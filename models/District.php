<?php

namespace dungphanxuan\vnlocation\models;

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
class District extends BaseModel
{

    /**
     * @var array
     */
    public $image;

    public $region_id;
    public $total_ward;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_district';
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
            [['city_id', 'name', 'code'], 'required'],
            [
                ['city_id', 'kind_from', 'kind_to', 'allow', 'priority', 'status', 'created_at', 'updated_at'],
                'integer'
            ],
            [['lat', 'lng'], 'number'],
            [
                ['name', 'slug', 'short_name', 'code', 'code_ghn', 'code_vtp', 'code_kerry'],
                'string',
                'max' => 32
            ],
            [['code_spl', 'full_name'], 'string', 'max' => 64],
            [['image_base_url', 'image_path'], 'string', 'max' => 255],
            [
                ['city_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => City::className(),
                'targetAttribute' => ['city_id' => 'id']
            ]
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
            'city_id' => 'City',
            'name' => 'District Name',
            'slug' => 'Slug',
            'full_name' => 'Full Name',
            'short_name' => 'Short Name',
            'code' => 'Code',
            'code_ghn' => 'Code Ghn',
            'code_vtp' => 'Code Vtp',
            'code_kerry' => 'Code Kerry',
            'code_spl' => 'Code Spl',
            'kind_from' => 'Kind From',
            'kind_to' => 'Kind To',
            'allow' => 'Allow',
            'priority' => 'Priority',
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
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoWards()
    {
        return $this->hasMany(Ward::className(), ['district_id' => 'id']);
    }

    public static function getDistricts($city_id)
    {
        $dataModel = District::find()
            ->where(['city_id' => $city_id])
            ->asArray()
            ->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');

        return $data;
    }

    /*
    * Get total video of category
    * */
    public function getTotal()
    {
        return $this->hasMany(Ward::className(), ['district_id' => 'id'])->count();
    }

    public static function getList()
    {
        $allData = District::find()->all();
        $dataItem = ArrayHelper::map($allData, 'id', 'name');

        return $dataItem;
    }
}
