<?php

namespace dungphanxuan\vnlocation\models;

use trntv\filekit\behaviors\UploadBehavior;
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
class GoRegion extends BaseModel
{

    public $total_city;
    /**
     * @var array
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'go_region';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'created_at',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 32],
            [['image_base_url', 'image_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'image' => 'Image',
            'image_base_url' => 'Image Base Url',
            'image_path' => 'Image Path',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoCities()
    {
        return $this->hasMany(City::className(), ['region_id' => 'id']);
    }

    /*
    * Get total video of category
    * */
    public function getTotal()
    {
        return $this->hasMany(City::className(), ['region_id' => 'id'])->count();
    }
}
