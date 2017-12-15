<?php

namespace dungphanxuan\vnlocation\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dungphanxuan\vnlocation\models\DemoLocation;

/**
 * DemoLocationSearch represents the model behind the search form of `dungphanxuan\vnlocation\models\DemoLocation`.
 */
class DemoLocationSearch extends DemoLocation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'district_id', 'ward_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'body', 'image_base_url', 'image_path'], 'safe'],
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
        $query = DemoLocation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'          => $this->id,
            'city_id'     => $this->city_id,
            'district_id' => $this->district_id,
            'ward_id'     => $this->ward_id,
            'status'      => $this->status,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'created_by'  => $this->created_by,
            'updated_by'  => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'image_base_url', $this->image_base_url])
            ->andFilterWhere(['like', 'image_path', $this->image_path]);

        return $dataProvider;
    }
}
