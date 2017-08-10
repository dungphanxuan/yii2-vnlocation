<?php

namespace dungphanxuan\vnlocation\models\go;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use dungphanxuan\vnlocation\models\go\District;

/**
 * DistrictSearch represents the model behind the search form about `dungphanxuan\vnlocation\models\go\District`.
 */
class DistrictSearch extends District {
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[
				[ 'id', 'city_id', 'kind_from', 'kind_to', 'allow', 'priority', 'status', 'created_at', 'updated_at' ],
				'integer'
			],
			[
				[
					'name',
					'slug',
					'full_name',
					'short_name',
					'code',
					'code_ghn',
					'code_vtp',
					'code_kerry',
					'code_spl',
					'image_base_url',
					'image_path'
				],
				'safe'
			],
			[ [ 'lat', 'lng' ], 'number' ],
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
		$query = District::find();

		$dataProvider = new ActiveDataProvider( [
			'query' => $query,
		] );

		if ( ! ( $this->load( $params ) && $this->validate() ) ) {
			return $dataProvider;
		}

		$query->andFilterWhere( [
			'id'         => $this->id,
			'city_id'    => $this->city_id,
			'kind_from'  => $this->kind_from,
			'kind_to'    => $this->kind_to,
			'allow'      => $this->allow,
			'priority'   => $this->priority,
			'lat'        => $this->lat,
			'lng'        => $this->lng,
			'status'     => $this->status,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at,
		] );

		$query->andFilterWhere( [ 'like', 'name', $this->name ] )
		      ->andFilterWhere( [ 'like', 'slug', $this->slug ] )
		      ->andFilterWhere( [ 'like', 'full_name', $this->full_name ] )
		      ->andFilterWhere( [ 'like', 'short_name', $this->short_name ] )
		      ->andFilterWhere( [ 'like', 'code', $this->code ] )
		      ->andFilterWhere( [ 'like', 'code_ghn', $this->code_ghn ] )
		      ->andFilterWhere( [ 'like', 'code_vtp', $this->code_vtp ] )
		      ->andFilterWhere( [ 'like', 'code_kerry', $this->code_kerry ] )
		      ->andFilterWhere( [ 'like', 'code_spl', $this->code_spl ] )
		      ->andFilterWhere( [ 'like', 'image_base_url', $this->image_base_url ] )
		      ->andFilterWhere( [ 'like', 'image_path', $this->image_path ] );

		return $dataProvider;
	}
}
