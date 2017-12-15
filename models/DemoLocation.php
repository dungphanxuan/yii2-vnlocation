<?php

namespace dungphanxuan\vnlocation\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "go_demo_location".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $city_id
 * @property int $district_id
 * @property int $ward_id
 * @property string $image_base_url
 * @property string $image_path
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 */
class DemoLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_demo_location';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['body'], 'string'],
            [['city_id', 'district_id', 'ward_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['image_base_url', 'image_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'title'          => 'Title',
            'body'           => 'Body',
            'city_id'        => 'City',
            'district_id'    => 'District',
            'ward_id'        => 'Ward',
            'image_base_url' => 'Image Base Url',
            'image_path'     => 'Image Path',
            'status'         => 'Status',
            'created_at'     => 'Created At',
            'updated_at'     => 'Updated At',
            'created_by'     => 'Created By',
            'updated_by'     => 'Updated By',
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
    public function getDistrict()
    {
        return $this->hasOne(District::className(), ['id' => 'district_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWard()
    {
        return $this->hasOne(Ward::className(), ['id' => 'ward_id']);
    }

}
