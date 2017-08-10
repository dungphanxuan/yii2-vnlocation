<?php

namespace dungphanxuan\vnlocation\controllers;

use Yii;
use dungphanxuan\vnlocation\models\GoRegion;
use dungphanxuan\vnlocation\models\GoRegionSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for GoRegion model.
 */
class RegionController extends Controller {
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
	 * Lists all GoRegion models.
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel  = new GoRegionSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [
			'searchModel'  => $searchModel,
			'dataProvider' => $dataProvider,
		] );
	}

	/**
	 * Displays a single GoRegion model.
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
	 * Creates a new GoRegion model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new GoRegion();

		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'create', [
			'model' => $model,
		] );
	}

	/**
	 * Updates an existing GoRegion model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionUpdate( $id ) {
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) ) {
			if ( $model->save() ) {
				return $this->redirect( [ 'index' ] );
			}
		}

		return $this->render( 'update', [
			'model' => $model,
		] );
	}

	/**
	 * Deletes an existing GoRegion model.
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

	/**
	 * Finds the GoRegion model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id
	 *
	 * @return GoRegion the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id ) {
		if ( ( $model = GoRegion::findOne( $id ) ) !== null ) {
			return $model;
		} else {
			throw new NotFoundHttpException( 'The GoRegion item does not exist.' );
		}
	}
}
