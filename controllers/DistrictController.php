<?php

namespace dungphanxuan\vnlocation\controllers;

use dungphanxuan\vnlocation\models\go\GoRegion;
use Yii;
use dungphanxuan\vnlocation\models\go\District;
use dungphanxuan\vnlocation\models\go\DistrictSearch;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DistrictController implements the CRUD actions for District model.
 */
class DistrictController extends Controller {
	public function behaviors() {
		return \yii\helpers\ArrayHelper::merge( parent::behaviors(), [
			'verbs' => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'post' ],
				],
			],
		] );
	}


	/**
	 * Lists all District models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new DistrictSearch();
		$params      = Yii::$app->request->queryParams;

		//Filter Category
		$getCity = getParam( 'city_id', null );
		if ( $getCity ) {
			$params['DistrictSearch']['city_id'] = $getCity;
		}
		$dataProvider = $searchModel->search( $params );

		return $this->render( 'index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single District model.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView( $id ) {
		return $this->render( 'view', [
			'model' => $this->findModel( $id ),
		] );
	}

	/**
	 * Creates a new District model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model    = new District();
		$dataCity = [];
		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'create', [
			'model'    => $model,
			'regions'  => GoRegion::find()->all(),
			'dataCity' => $dataCity,
		] );
	}

	/**
	 * Updates an existing District model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate( $id ) {
		$model    = $this->findModel( $id );
		$dataCity = [];

		/*Remember Url*/
		$backUrl  = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : null;
		$cookies1 = Yii::$app->response->cookies;
		if ( $backUrl ) {
			$cookies1->add( new \yii\web\Cookie( [
				'name'  => 'url5',
				'value' => $backUrl,
			] ) );
		} else {
			$cookies1->remove( 'url5' );
		}

		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {

				/*Remember Url*/
				$cookies     = Yii::$app->request->cookies;
				$url1        = $cookies->getValue( 'url5', null );
				$isUpdateUrl = strpos( $url1, 'update' );
				if ( $url1 && ! $isUpdateUrl ) {
					return $this->redirect( $url1 );
				}

				return $this->redirect( [ 'index' ] );
			}
		} else {
			//Init region data
			$model->region_id = $model->city->region_id;
			$dataCity         = \dungphanxuan\vnlocation\models\go\City::getCities( $model->region_id );

		}

		return $this->render( 'update', [
			'model'    => $model,
			'regions'  => GoRegion::find()->all(),
			'dataCity' => $dataCity,
		] );
	}

	/**
	 * Deletes an existing District model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete( $id ) {
		throw new ForbiddenHttpException( 'Not Allow' );

		//$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	// THE CONTROLLER
	public function actionSubcat() {
		$out = [];
		if ( isset( $_POST['depdrop_parents'] ) ) {
			$parents = $_POST['depdrop_parents'];
			if ( $parents != null ) {
				$cat_id = $parents[0];

				$out  = District::find()
				                ->where( [ 'city_id' => $cat_id ] )
				                ->asArray()
				                ->all();
				$data = [];
				foreach ( $out as $item ) {
					$dataDistrict         = [];
					$dataDistrict['id']   = $item['id'];
					$dataDistrict['name'] = $item['name'];
					$data[]               = $dataDistrict;
				}
				echo Json::encode( [ 'output' => $data, 'selected' => '' ] );

				return;
			}
		}
		echo Json::encode( [ 'output' => '', 'selected' => '' ] );
	}

	/*************
	 * Controller Ajax Get District list
	 ************/
	public function actionDistrictList( $q = null, $id = null ) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out                         = [ 'results' => [ 'id' => '', 'text' => '' ] ];
		if ( ! is_null( $q ) ) {
			$query = new Query();
			$query->select( 'id, name AS text' )
			      ->from( District::getTableSchema()->name )
			      ->where( [ 'like', 'name', $q ] )
			      ->limit( 20 );
			$command        = $query->createCommand();
			$data           = $command->queryAll();
			$out['results'] = array_values( $data );
		} elseif ( $id > 0 ) {
			$modelDetail = District::find()->where( [ 'id' => $id ] )->one();
			$name        = '';
			if ( $modelDetail ) {
				$name = $modelDetail->name;
			}
			$out['results'] = [ 'id' => $id, 'text' => $name ];
		}

		return $out;
	}

	/**
	 * Finds the District model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return District the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = District::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The District item does not exist.' );
		}
	}
}
