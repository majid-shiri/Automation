<?php

namespace app\controllers;

use app\models\Permits;
use app\models\Roles;
use app\models\Users;
use app\models\UsersSearch;
use Dompdf\Helpers;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
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
                    'only' => ['create','update','delete','logout','index'],
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
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new Users();
        if ($model->load($this->request->post()) ){
            $model->us_password = md5($model->us_password);
            $model->us_created_at = strtotime(date('Y-m-d G:i:s'));
            $model->us_updated_at = '---';
            $model->imagesign = UploadedFile::getInstance($model, 'imagesign');
            if (!empty($model->imagesign && $model->validate())) {
                if ($model->us_sign) {
                    unlink($model->us_sign);
                }
                $fn = time() . '.' . $model->imagesign->extension;
                $path = 'uploads/sign/' . $fn;
                $model->us_sign = $path;
            }
            if ($model->save()) {
                if (!empty($model->imagesign && $model->validate())) {
                    $model->imagesign->saveAs($path);
                }
            }
        }
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param int $us_id Us ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($us_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($us_id),
            'roles'=>$roles,
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ){
                $model->us_password = md5($model->us_password);
                $model->us_created_at = strtotime(date('Y-m-d G:i:s'));
                $model->us_updated_at = '---';
                $model->imagesign = UploadedFile::getInstance($model, 'imagesign');
                if (!empty($model->imagesign && $model->validate())) {
                    if ($model->us_sign) {
                        unlink($model->us_sign);
                    }
                    $fn = time() . '.' . $model->imagesign->extension;
                    $path = 'uploads/sign/' . $fn;
                    $model->us_sign = $path;
                }
                if ($model->save()) {
                    if (!empty($model->imagesign && $model->validate())) {
                        $model->imagesign->saveAs($path);
                    }
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $us_id Us ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($us_id)
    {
        $model = $this->findModel($us_id);
        $model->us_password = md5($model->us_password);
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ){
                $model->us_password = md5($model->us_password);
                $model->us_updated_at = strtotime(date('Y-m-d G:i:s'));
                $model->imagesign = UploadedFile::getInstance($model, 'imagesign');
                if (!empty($model->imagesign && $model->validate())) {
                    if($model->us_sign){
                        unlink($model->us_sign);
                    }
                    $fn=time(). '.' . $model->imagesign->extension;
                    $path = 'uploads/sign/' . $fn;
                    $model->us_sign = $path;
                }
                if($model->save()) {
                    if (!empty($model->imagesign && $model->validate())) {
                        $model->imagesign->saveAs($path);
                    }
                    return $this->redirect(['index']);

                }}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $us_id Us ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($us_id)
    {
        $model=$this->findModel($us_id);
        if($model->us_pic){
            unlink($model->us_pic);
        }
        if($model->us_sign){
            unlink($model->us_sign);
        }
        $model->delete();
        return $this->redirect(['index']);
    }
    public function actionTest()
    {

    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $us_id Us ID
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($us_id)
    {
        if (($model = Users::findOne($us_id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionProfile(){

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $us_id=$data['id'];
            $model=$this->findModel($us_id);
            $Rolemodel = Roles::findOne($model->us_role);
            return $this->renderAjax('_formprofile', [
                'model' => $model,
                'Rolemodel'=>$Rolemodel,
            ]);
        }
    }
    public function actionSaveimage(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $model=$this->findModel($data['id']);
            $file=$_FILES['file'];
            //print_r($_FILES);
            $fileName = time().$file['name'];
            $fileType = $file['type'];
            $fileError = $file['error'];
            $dire="uploads/profile/" . $fileName;
            $fileContent = file_get_contents($file['tmp_name']);

            if($fileError == UPLOAD_ERR_OK){
                move_uploaded_file( $file['tmp_name'], $dire);
                if($model->us_pic){
                    unlink($model->us_pic);
                    $model->us_pic=$dire;
                    $model->update();
                }else{
                    $model->us_pic=$dire;
                    $model->save();
                }
                Yii::$app->session->set('us_pic',$model->us_pic);
                echo $model->us_pic;
            }else{
                switch($fileError){
                    case UPLOAD_ERR_INI_SIZE:
                        $message = 'هنگام تلاش برای آپلود فایلی که بیش از اندازه مجاز بود، خطایی روی داد.';
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $message = 'هنگام تلاش برای آپلود فایلی که بیش از اندازه مجاز بود، خطایی روی داد.';
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $message = 'خطا: آپلود فایل تمام نشد.';
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $message = 'خطا: هیچ فایلی آپلود نشد.';
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $message = 'خطا: سرور برای آپلود فایل پیکربندی نشده است.';
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $message= 'خطا: امکان ذخیره فایل وجود ندارد.';
                        break;
                    case  UPLOAD_ERR_EXTENSION:
                        $message = 'خطا: آپلود فایل کامل نشد.';
                        break;
                    default: $message = 'خطا:آپلود فایل کامل نشد';
                        break;
                }
                echo json_encode(array(
                    'error' => true,
                    'message' => $message
                ));
            }
        }
    }
    public function actionPermits(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $us_id = $data['id'];
            $name = $data['name'];
            $PUS=Permits::findOne(['permit_us_id'=>$us_id]);
            if($PUS){
                $pusArray = ArrayHelper::toArray($PUS);
                $pusArray['names']=$name;
                $response = Yii::$app->response;
                $response->format = \yii\web\Response::FORMAT_JSON;
                $response->data = $pusArray;
                return $response;
            }else{
                echo 0;
            }
        }
    }
    public function actionPermitsUpdate(){
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $data = $data['data'];
            $us_id=$data['22'];
            $PUS=Permits::findOne(['permit_us_id'=>$us_id]);
            if($PUS){
                $PUS->permit_10=$data['0'];
                $PUS->permit_11=$data['1'];
                $PUS->permit_12=$data['2'];
                $PUS->permit_13=$data['3'];
                $PUS->permit_14=$data['4'];
                $PUS->permit_15=$data['5'];
                $PUS->permit_16=$data['6'];
                $PUS->permit_20=$data['7'];
                $PUS->permit_21=$data['8'];
                $PUS->permit_22=$data['9'];
                $PUS->permit_23=$data['10'];
                $PUS->permit_24=$data['11'];
                $PUS->permit_25=$data['12'];
                $PUS->permit_30=$data['13'];
                $PUS->permit_31=$data['14'];
                $PUS->permit_32=$data['15'];
                $PUS->permit_33=$data['16'];
                $PUS->permit_40=$data['17'];
                $PUS->permit_41=$data['18'];
                $PUS->permit_42=$data['19'];
                $PUS->permit_43=$data['20'];
                $PUS->permit_44=$data['21'];
                $PUS->update();
                $session = Yii::$app->session;
                if($session->get('us_id')==$us_id){
                    $session->remove('permit_10');
                    $session->set('permit_10',$data['0']);
                    $session->remove('permit_11');
                    $session->set('permit_11',$data['1']);
                    $session->remove('permit_12');
                    $session->set('permit_12',$data['2']);
                    $session->remove('permit_13');
                    $session->set('permit_13',$data['3']);
                    $session->remove('permit_14');
                    $session->set('permit_14',$data['4']);
                    $session->remove('permit_15');
                    $session->set('permit_15',$data['5']);
                    $session->remove('permit_16');
                    $session->set('permit_16',$data['6']);
                    $session->remove('permit_20');
                    $session->set('permit_20',$data['7']);
                    $session->remove('permit_21');
                    $session->set('permit_21',$data['8']);
                    $session->remove('permit_22');
                    $session->set('permit_22',$data['9']);
                    $session->remove('permit_23');
                    $session->set('permit_23',$data['10']);
                    $session->remove('permit_24');
                    $session->set('permit_24',$data['11']);
                    $session->remove('permit_25');
                    $session->set('permit_25',$data['12']);
                    $session->remove('permit_30');
                    $session->set('permit_30',$data['13']);
                    $session->remove('permit_31');
                    $session->set('permit_31',$data['14']);
                    $session->remove('permit_32');
                    $session->set('permit_32',$data['15']);
                    $session->remove('permit_33');
                    $session->set('permit_33',$data['16']);
                    $session->remove('permit_40');
                    $session->set('permit_40',$data['17']);
                    $session->remove('permit_41');
                    $session->set('permit_41',$data['18']);
                    $session->remove('permit_42');
                    $session->set('permit_42',$data['19']);
                    $session->remove('permit_43');
                    $session->set('permit_43',$data['20']);
                    $session->remove('permit_44');
                    $session->set('permit_44',$data['21']);
                }
                return true;
            }else{
                echo 0;
            }
        }
    }
}
