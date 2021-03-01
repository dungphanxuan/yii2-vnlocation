<?php

namespace dungphanxuan\vnlocation\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CitySearch represents the model behind the search form about `dungphanxuan\vnlocation\models\City`.
 */
class CitySearch extends City
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'allow', 'priority', 'status', 'created_at', 'updated_at'], 'integer'],
            [
                [
                    'name',
                    'slug',
                    'short_name',
                    'code',
                    'code_ghn',
                    'code_vtp',
                    'code_njv',
                    'code_kerry',
                    'image_base_url',
                    'image_path'
                ],
                'safe'
            ],
            [['lat', 'lng'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
// bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = City::find()
            ->with('region')
            ->orderBy(['priority' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'region_id' => $this->region_id,
            'allow' => $this->allow,
            'priority' => $this->priority,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'code_ghn', $this->code_ghn])
            ->andFilterWhere(['like', 'code_vtp', $this->code_vtp])
            ->andFilterWhere(['like', 'code_njv', $this->code_njv])
            ->andFilterWhere(['like', 'code_kerry', $this->code_kerry])
            ->andFilterWhere(['like', 'image_base_url', $this->image_base_url])
            ->andFilterWhere(['like', 'image_path', $this->image_path]);

        return $dataProvider;
    }
}
