<?php

namespace dungphanxuan\vnlocation\controllers;

use dungphanxuan\vnlocation\models\City;
use dungphanxuan\vnlocation\models\District;
use dungphanxuan\vnlocation\models\Ward;
use Yii;
use dungphanxuan\vnlocation\models\DemoLocation;
use dungphanxuan\vnlocation\models\DemoLocationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DemoLocationController implements the CRUD actions for DemoLocation model.
 */
class DemoLocationController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DemoLocation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DemoLocationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DemoLocation model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DemoLocation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DemoLocation();

        $dataDistrict = [];
        $dataWard = [];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model'        => $model,
            'cities'       => City::find()->orderBy('priority desc')->all(),
            'dataDistrict' => $dataDistrict,
            'dataWard'     => $dataWard,
        ]);
    }

    /**
     * Updates an existing DemoLocation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        //Init region data
        $dataDistrict = District::getDistricts($model->city_id);
        $dataWard = Ward::getWards($model->district_id);


        return $this->render('update', [
            'model'        => $model,
            'cities'       => City::find()->orderBy('priority desc')->all(),
            'dataDistrict' => $dataDistrict,
            'dataWard'     => $dataWard,
        ]);
    }

    /**
     * Deletes an existing DemoLocation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DemoLocation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DemoLocation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DemoLocation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
