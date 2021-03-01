<?php

namespace dungphanxuan\vnlocation\controllers;

use dungphanxuan\vnlocation\helpers\MapHelper;
use dungphanxuan\vnlocation\models\City;
use dungphanxuan\vnlocation\models\CitySearch;
use dungphanxuan\vnlocation\models\GoRegion;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CityController implements the CRUD actions for City model.
 */
class CityController extends Controller
{

    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return \yii\helpers\ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }


    /**
     * Lists all City models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CitySearch();
        $params = Yii::$app->request->queryParams;

        //Filter Category
        $getRegion = Yii::$app->request->get('region_id', null);
        if ($getRegion) {
            $params['CitySearch']['region_id'] = $getRegion;
        }
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single City model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new City model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new City();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'regions' => GoRegion::find()->all(),
        ]);
    }

    /**
     * Updates an existing City model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            if (empty($model->lat)) {
                $dataLocation = MapHelper::getLocationbyAddress($model->name);
                if ($dataLocation) {
                    $model->lat = $dataLocation->lat;
                    $model->lng = $dataLocation->lng;
                    $model->save(false);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'regions' => GoRegion::find()->all(),
        ]);
    }

    /**
     * Deletes an existing City model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        //throw new ForbiddenHttpException( 'Not Allow' );

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // THE CONTROLLER
    public function actionSubcat()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];

                $out = City::find()
                    ->where(['region_id' => $cat_id])
                    ->asArray()
                    ->all();
                $data = [];
                foreach ($out as $item) {
                    $dataCity = [];
                    $dataCity['id'] = $item['id'];
                    $dataCity['name'] = $item['name'];
                    $data[] = $dataCity;
                }
                echo Json::encode(['output' => $data, 'selected' => '']);

                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Finds the City model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return City the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = City::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The City item does not exist.');
        }
    }
}
