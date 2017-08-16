<?php

namespace dungphanxuan\vnlocation\controllers;

use dungphanxuan\vnlocation\helpers\MapHelper;
use dungphanxuan\vnlocation\models\GoRegion;
use Yii;
use dungphanxuan\vnlocation\models\District;
use dungphanxuan\vnlocation\models\City;
use dungphanxuan\vnlocation\models\Ward;
use dungphanxuan\vnlocation\models\WardSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WardController implements the CRUD actions for Ward model.
 */
class WardController extends Controller {

	public $enableCsrfValidation = false;

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
	 * Lists all Ward models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new WardSearch();
		$params      = Yii::$app->request->queryParams;

		//Filter Category
		$getDistrict = Yii::$app->request->get( 'district_id', null );
		if ( $getDistrict ) {
			$params['WardSearch']['district_id'] = $getDistrict;
		}

		$dataProvider = $searchModel->search( $params );

		return $this->render( 'index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single Ward model.
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
	 * Creates a new Ward model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model        = new Ward();
		$dataCity     = [];
		$dataDistrict = [];
		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'create', [
			'model'        => $model,
			'regions'      => GoRegion::find()->all(),
			'dataCity'     => $dataCity,
			'dataDistrict' => $dataDistrict,
			'districts'    => District::find()->all(),
		] );
	}

	/**
	 * Updates an existing Ward model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate( $id ) {
		$model        = $this->findModel( $id );
		$dataCity     = [];
		$dataDistrict = [];

		/*Remember Url*/
		$backUrl  = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : null;
		$cookies1 = Yii::$app->response->cookies;
		if ( $backUrl ) {
			$cookies1->add( new \yii\web\Cookie( [
				'name'  => 'url2',
				'value' => $backUrl,
			] ) );
		} else {
			$cookies1->remove( 'url2' );
		}

		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {

				/*Remember Url*/
				$cookies     = Yii::$app->request->cookies;
				$url1        = $cookies->getValue( 'url2', null );
				$isUpdateUrl = strpos( $url1, 'update' );
				if ( $url1 && ! $isUpdateUrl ) {
					return $this->redirect( $url1 );
				}

				return $this->redirect( [ 'index' ] );
			}
		} else {
			//Init region data
			$model->region_id = $model->district->city->region_id;
			$model->city_id   = $model->district->city->id;
			$dataCity         = City::getCities( $model->region_id );
			$dataDistrict     = District::getDistricts( $model->city_id );

			//Find Location
			if ( empty( $model->lat ) ) {
				$dataLocation = MapHelper::getLocationbyAddress( $model->fullname );
				if ( $dataLocation ) {
					$model->lat = $dataLocation->lat;
					$model->lng = $dataLocation->lng;
					$model->save( false );
				}
			}
		}

		return $this->render( 'update', [
			'model'        => $model,
			'regions'      => GoRegion::find()->all(),
			'dataCity'     => $dataCity,
			'dataDistrict' => $dataDistrict,
			'districts'    => District::find()->all(),
		] );
	}

	/**
	 * Deletes an existing Ward model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionDelete( $id ) {
		//throw new ForbiddenHttpException( 'Not Allow' );

		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	// THE CONTROLLER
	public function actionSubcat() {
		$out = [];
		if ( isset( $_POST['depdrop_parents'] ) ) {
			$parents = $_POST['depdrop_parents'];
			if ( $parents != null ) {
				$cat_id = $parents[0];

				$out  = Ward::find()
				            ->where( [ 'district_id' => $cat_id ] )
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


	/**
	 * Finds the Ward model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return Ward the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = Ward::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The Ward item does not exist.' );
		}
	}
}
