<?php

namespace app\controllers;

use app\models\Permits;
use app\models\PermitsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PermitsController implements the CRUD actions for Permits model.
 */
class PermitsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Permits models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PermitsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permits model.
     * @param int $permit_id Permit ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($permit_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($permit_id),
        ]);
    }

    /**
     * Creates a new Permits model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Permits();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'permit_id' => $model->permit_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Permits model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $permit_id Permit ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($permit_id)
    {
        $model = $this->findModel($permit_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'permit_id' => $model->permit_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Permits model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $permit_id Permit ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($permit_id)
    {
        $this->findModel($permit_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Permits model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $permit_id Permit ID
     * @return Permits the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($permit_id)
    {
        if (($model = Permits::findOne(['permit_id' => $permit_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
