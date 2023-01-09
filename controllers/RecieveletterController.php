<?php

namespace app\controllers;

use app\models\Copies;
use app\models\Signature;
use app\models\Users;
use app\models\VwRecieveletter;
use app\models\VwRecieveletterSearch;
use hoomanMirghasemi\jdf\Jdf;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RecieveletterController implements the CRUD actions for VwRecieveletter model.
 */
class RecieveletterController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['create', 'update', 'delete', 'logout', 'index'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all VwRecieveletter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VwRecieveletterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VwRecieveletter model.
     * @param int $let_Id Let  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($let_Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($let_Id),
        ]);
    }
    /**
     * Creates a new VwRecieveletter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VwRecieveletter();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'let_Id' => $model->let_Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VwRecieveletter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $let_Id Let  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($let_Id)
    {
        $model = $this->findModel($let_Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'let_Id' => $model->let_Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VwRecieveletter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $let_Id Let  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($let_Id)
    {
        $this->findModel($let_Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the VwRecieveletter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $let_Id Let  ID
     * @return VwRecieveletter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($let_Id)
    {
        if (($model = VwRecieveletter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionTest(){

    }
}
