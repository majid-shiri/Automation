<?php

namespace app\controllers;

use app\models\Signature;
use app\models\SignatureSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SignatureController implements the CRUD actions for Signature model.
 */
class SignatureController extends Controller
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
     * Lists all Signature models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SignatureSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Signature model.
     * @param int $sig_id Sig ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($sig_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($sig_id),
        ]);
    }

    /**
     * Creates a new Signature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Signature();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'sig_id' => $model->sig_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Signature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $sig_id Sig ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($sig_id)
    {
        $model = $this->findModel($sig_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'sig_id' => $model->sig_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Signature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $sig_id Sig ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($sig_id)
    {
        $this->findModel($sig_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Signature model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $sig_id Sig ID
     * @return Signature the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($sig_id)
    {
        if (($model = Signature::findOne(['sig_id' => $sig_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSings(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model=Signature::findOne(['sig_us_id'=>$data['usid'],'sig_let_id'=>$data['id']]);
            if ($model->sig_state!=1){
                $model->sig_state=1;
                $model->sig_date=strtotime(date('Y-m-d G:i:s'));
                $model->update();
               echo 1;
            }else{
                echo 0;
            }

        }
    }
}
