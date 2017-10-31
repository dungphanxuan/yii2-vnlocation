<?php

namespace dungphanxuan\vnlocation\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * WardSearch represents the model behind the search form about `dungphanxuan\vnlocation\models\Ward`.
 */
class WardSearch extends Ward
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'district_id', 'priority', 'status', 'created_at', 'updated_at'], 'integer'],
            [
                ['name', 'slug', 'fullname', 'short_name', 'code_vtp', 'code_spl', 'image_base_url', 'image_path'],
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
        $query = Ward::find()->with('district');

        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'          => $this->id,
            'district_id' => $this->district_id,
            'priority'    => $this->priority,
            'lat'         => $this->lat,
            'lng'         => $this->lng,
            'status'      => $this->status,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'code_vtp', $this->code_vtp])
            ->andFilterWhere(['like', 'code_spl', $this->code_spl])
            ->andFilterWhere(['like', 'image_base_url', $this->image_base_url])
            ->andFilterWhere(['like', 'image_path', $this->image_path]);

        return $dataProvider;
    }
}
