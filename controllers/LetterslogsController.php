<?php

namespace app\controllers;

use app\models\Letterslogs;
use app\models\LetterslogsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LetterslogsController implements the CRUD actions for Letterslogs model.
 */
class LetterslogsController extends Controller
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
     * Lists all Letterslogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LetterslogsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Letterslogs model.
     * @param int $let_log_Id Let Log  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($let_log_Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($let_log_Id),
        ]);
    }

    /**
     * Creates a new Letterslogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Letterslogs();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'let_log_Id' => $model->let_log_Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Letterslogs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $let_log_Id Let Log  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($let_log_Id)
    {
        $model = $this->findModel($let_log_Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'let_log_Id' => $model->let_log_Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Letterslogs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $let_log_Id Let Log  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($let_log_Id)
    {
        $this->findModel($let_log_Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Letterslogs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $let_log_Id Let Log  ID
     * @return Letterslogs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($let_log_Id)
    {
        if (($model = Letterslogs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
