<?php

namespace dungphanxuan\vnlocation\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * GoRegionSearch represents the model behind the search form about `dungphanxuan\vnlocation\models\GoRegion`.
 */
class GoRegionSearch extends GoRegion {
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[ [ 'id', 'status', 'created_at' ], 'integer' ],
			[ [ 'title', 'slug', 'image_base_url', 'image_path' ], 'safe' ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function scenarios() {
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
	public function search( $params ) {
		$query = GoRegion::find();

		$dataProvider = new ActiveDataProvider( [
			'query' => $query,
		] );

		if ( ! ( $this->load( $params ) && $this->validate() ) ) {
			return $dataProvider;
		}

		$query->andFilterWhere( [
			'id'         => $this->id,
			'status'     => $this->status,
			'created_at' => $this->created_at,
		] );

		$query->andFilterWhere( [ 'like', 'title', $this->title ] )
		      ->andFilterWhere( [ 'like', 'slug', $this->slug ] )
		      ->andFilterWhere( [ 'like', 'image_base_url', $this->image_base_url ] )
		      ->andFilterWhere( [ 'like', 'image_path', $this->image_path ] );

		return $dataProvider;
	}
}
