<?php

namespace app\controllers;

use app\models\Attaches;
use app\models\Copies;
use app\models\Letters;
use app\models\Letterslogs;
use app\models\LettersSearch;
use app\models\Permits;
use app\models\Refconfirm;
use app\models\Referencs;
use app\models\Roles;
use app\models\Signature;
use app\models\Users;
use hoomanMirghasemi\jdf\Jdf;
use kartik\mpdf\Pdf;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

/**
 * LettersController implements the CRUD actions for Letters model.
 */
class LettersController extends Controller
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
     * Lists all Letters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LettersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Letters model.
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
     * Creates a new Letters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $LettersTransaction = Letters::getDb()->beginTransaction();
        try {

            $session = \Yii::$app->session;
            $model = new Letters();
            $log = new Letterslogs();
            $permit_sign = ArrayHelper::map(Permits::find()->where(['permit_22'=>1])->all(),'permit_id','permit_us_id');
            $role=Users::RolesArray();
            $userpermit='';
            foreach (Users::find()->where(['us_id' => $permit_sign])->all() as $key=>$value)
            {
                $userpermit= $userpermit."<option value=".$value->us_id.">".$value->us_fname.' '.$value->us_lname.'('.$role[$value->us_role].')'."</option>";
            }
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $request=Yii::$app->request;
                    $sigs=$request->post('sigs');
                    $model->let_Create_at = strtotime(date('Y-m-d G:i:s'));
                    $model->let_Date = $this->changeDate($model->let_Date, 'str');
                    $model->let_State = '0';
                    $model->let_Referral = '0';
                    $model->let_ReplayType = '0';
                    $model->let_ReplayType = '0';
                    $model->let_AttachType = '0';
                    $model->let_ParaffType = '0';
                    $model->let_CopiesType = '0';
                    $model->let_refconf = '0';
                    $model->let_refconf_state = '0';
                    ($model->let_FollowUpType) ? $model->let_FollowUpType = '1' : $model->let_FollowUpType = '0';
                    ($model->let_ArchiveType) ? $model->let_ArchiveType = '1' : $model->let_ArchiveType = '0';
                    ($model->let_ResDateType) ? $model->let_ResDateType = '1' : $model->let_ResDateType = '0';
                    if ($model->let_ResDate != null) {
                        $model->let_ResDate = $this->changeDate($model->let_ResDate, 'str');
                    } else {
                        $model->let_ResDate = null;
                    }
                    if (!empty($model->Copies)) {
                        $model->let_CopiesType = '1';
                    }
                    $Numberlet = $this->numletGenrator();
                    $model->let_NumberSys = $Numberlet;
                    ($model->let_NumberIn) ? $model->let_NumberIn = $model->let_NumberIn : $model->let_NumberIn = $Numberlet;
                    $model->let_us_FK = $session->get('us_id');
                    $usFK = $model->let_us_FK;
                    $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
                    if (!empty($model->imageFiles && $model->validate())) {
                        $model->let_AttachType = 1;
                    }
                    if ($model->save()) {

                        $id = $model->let_Id;
                        if (!empty($model->Copies)) {
                            foreach ($model->Copies as $c2) {
                                $Cop1 = new Copies();
                                $Cop1->cop_Title = $c2;
                                $Cop1->cop_let_FK = $id;
                                $Cop1->save();
                            }
                        }
                        if (!empty($sigs)) {
                            foreach ($sigs as $key=> $c) {
                                $sig = new Signature();
                                $sig->sig_us_id = $c[$key];
                                $sig->sig_let_id = $id;
                                $sig->sig_state=0;
                                $sig->sig_date=null;
                                $sig->save();
                            }
                        }
                        $model->letlog('Draft', $usFK, $id, $Numberlet);
                        $model->upload($id, $usFK);
                        $LettersTransaction->commit();
                        return $this->redirect(['index']);
                    }
                }
            } else {
                $model->loadDefaultValues();
            }
            return $this->renderAjax('create', [
                'model' => $model,
                'userpermit'=>$userpermit,
            ]);
        } catch (\Exception $e) {
            $LettersTransaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $LettersTransaction->rollBack();
            throw $e;
        }
    }

    /**
     * Updates an existing Letters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $let_Id Let  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($let_Id)
    {

        $model = $this->findModel($let_Id);
        $attach = Attaches::find()->where(['at_Letters_FK' => $model->let_Id])->all();
        $cop = ArrayHelper::map(Copies::find()->where(['cop_let_FK' => $let_Id])->all(),'cop_Id','cop_Title');
        $permit_sign = ArrayHelper::map(Permits::find()->where(['permit_22'=>1])->all(),'permit_id','permit_us_id');
        $role=Users::RolesArray();
        $userpermit='';
        $sigs='';
        foreach (Users::find()->where(['us_id' => $permit_sign])->all() as $key=>$value)
        {
            $userpermit= $userpermit."<option value=".$value->us_id.">".$value->us_fname.' '.$value->us_lname.'('.$role[$value->us_role].')'."</option>";
        }
        if($model->let_Type!=1){
            $sig=ArrayHelper::getColumn(Signature::find()->where(['sig_let_id'=>$let_Id])->all(),'sig_us_id');
            $sigs=implode(',',$sig);
        }
        if ($this->request->isPost && $model->load($this->request->post())) {
            $request=Yii::$app->request;
            $sigs=$request->post('sigs');
            $model->let_Edit_at = strtotime(date('Y-m-d G:i:s'));
            $model->let_Date = $this->changeDate($model->let_Date, 'str');
            ($model->let_FollowUpType) ? $model->let_FollowUpType = '1' : $model->let_FollowUpType = '0';
            ($model->let_ArchiveType) ? $model->let_ArchiveType = '1' : $model->let_ArchiveType = '0';
            ($model->let_ResDateType) ? $model->let_ResDateType = '1' : $model->let_ResDateType = '0';
            if ($model->let_ResDate != null) {
                $model->let_ResDate = $this->changeDate($model->let_ResDate, 'str');
            } else {
                $model->let_ResDate = null;
            }
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if (!empty($model->imageFiles && $model->validate())) {
                $model->let_AttachType = 1;
            }
            $model->let_CopiesType = '0';


            if (!empty($model->Copies)) {
                $a1=array_column($cop,'cop_Id');
                $a2=array_diff($a1,$model->Copies);
                $model->let_CopiesType = '1';
                foreach($model->Copies as $num) {
                    if (!in_array($num,$a1)) {
                        $Cop1 = new Copies();
                        $Cop1->cop_Title = $num;
                        $Cop1->cop_let_FK = $model->let_Id;
                        $Cop1->save();
                    }
                }
                foreach ($cop as $icop) {
                    foreach ($a2 as $d2){
                        if($d2==$icop->cop_Id){
                            $icop->delete();
                        }
                    }
                }
            }
            Signature::deleteAll(['sig_let_id' => $let_Id]);
            if($model->let_Type!=1){
                if (!empty($sigs)) {
                    foreach ($sigs as $key=> $c) {
                        $sig = new Signature();
                        $sig->sig_us_id = $c[$key];
                        $sig->sig_let_id = $model->let_Id;
                        $sig->sig_state=0;
                        $sig->sig_date=null;
                        $sig->save();
                    }
                }
            }

            if ($model->save()) {
                $model->upload($model->let_Id, $model->let_us_FK);
                return $this->redirect(['index']);
            }
        }
        $model->let_Date = Jdf::jdate('Y/m/d', $model->let_Date);
        ($model->let_ResDate) ? $model->let_ResDate = Jdf::jdate('Y/m/d', $model->let_ResDate) : '';
        return $this->render('update', [
            'model' => $model,
            'attach' => $attach,
            'cop' => $cop,
            'userpermit'=>$userpermit,
            'sigs'=>$sigs,
        ]);

    }

    /**
     * Deletes an existing Letters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $let_Id Let  ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($let_Id, $let_numsys)
    {
        $session = \Yii::$app->session;
        $usFK = $session->get('us_id');
        $this->findModel($let_Id)->delete();
        foreach (Attaches::find()->where(['at_Letters_FK' => $let_Id])->all() as $user) {
            unlink($user->at_Url);
            $user->delete();
        }
        Copies::deleteAll(['cop_let_FK' => $let_Id]);
        Signature::deleteAll(['sig_let_id' => $let_Id]);
        Letters::letlog('trashDraft', $usFK, $let_Id, $let_numsys);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Letters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $let_Id Let  ID
     * @return Letters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($let_Id)
    {
        if (($model = Letters::findOne($let_Id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

//مشاهده نامه
    public function actionViewLetter()
    {
        if (Yii::$app->request->isAjax) {

            $data = Yii::$app->request->post();
            $let_Id = $data['id'];
            $signature=[];
            if(!empty($sigs=Signature::find()->where(['sig_let_id'=>$let_Id])->all())){
                $sign=ArrayHelper::getColumn($sigs,'sig_us_id');
                $stamp=ArrayHelper::map($sigs,'sig_us_id','sig_state');
                $role=Users::RolesArray();
                foreach (Users::find()->select(['us_id','us_fname','us_lname','us_role','us_sign'])->where(['IN','us_id',$sign])->all() as $key=>$value)
                {
                    if($stamp[$value->us_id]==1){
                        $stp=Html::img(Url::to('@web/web/imgprofile/stamp.png'), ['width'=>'200px','class'=>'stamp']).Html::img(Url::to('@web/'. $value->us_sign), ['width'=>'200px','class'=>'singActor']);
                    }else{
                        $stp='';
                    }
                    $signature[$key] ='<td style="; height: 220px; padding: 0px; text-align: center; width: 500px;"><div>'.$stp.'</div><p><br/><br/>'. $value->us_fname.' '.$value->us_lname.'</br>'.$role[$value->us_role].'</p></td>';
                }
            }
            if($data['reads']==1){
                $usid= $data['usid'];
                $model2=Referencs::find()->where(['ref_let_FK'=>$let_Id,'ref_us_FK'=>$usid])->one();
                if($model2->ref_readstate==0){
                    $model2->ref_readstate=1;
                    $model2->update();
                }
            }
            $model = $this->findModel($let_Id);
            $cop =Copies::find()->where(['cop_let_FK' => $let_Id])->all();
            $model->let_Date = Jdf::jdate('Y/m/d', $model->let_Date);
            ($model->let_AttachType == '1') ? $model->let_AttachType = 'دارد' : $model->let_AttachType = 'ندارد';
            $model->let_NumberIn = $this->cEnToFa($model->let_NumberIn);
            return $content = $this->renderPartial('_formLetterRes', [
                'model' => $model,
                'cop' => $cop,
                'signature'=>$signature,
            ]);
        }

    }
    //ارجاع نامه
    public function actionReferralLetter(){
        $model=new Referencs();
        $session = Yii::$app->session;
        $us_id=$session->get('us_id');
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $let_Id = $data['id'];
            $users = array();
            $role=Users::RolesArray();
            foreach (Users::find()->select(['us_id','us_fname','us_lname','us_role'])->where(['NOT IN','us_id',$us_id])->all() as $key=>$value)
            {
                $users[$value->us_id] = $value->us_fname.' '.$value->us_lname.'('.$role[$value->us_role].')';
            }
            return $this->renderAjax('_formRef', [
                'model' => $model,
                'users'=>$users,
                'let_Id'=>$let_Id,
            ]);
        }
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()))
            {
                $FindUsers = Users::find()->select(['us_id'])->where(['IN','us_id',$model->ref_us_FK])->all();
                $letter = $this->findModel($model->ref_let_FK);
                $model1= new Letters();
                foreach ($FindUsers as $iValRef){
                    $referall=new Referencs();
                    $referall->ref_sender_FK=$us_id;
                    $referall->ref_us_FK=$iValRef->us_id;
                    $referall->ref_let_FK=$model->ref_let_FK;
                    $referall->ref_readstate=0;
                    $referall->ref_date=strtotime(date('Y-m-d G:i:s'));
                    $referall->save();
                }
                $model1->letlog('Referral', $us_id, $model->ref_let_FK, $letter->let_NumberSys);
                $letter->let_State=1;
                $letter->let_Referral=1;
                $letter->update();
                return $this->redirect(['index']);
            }
        }

    }

    public function actionRefconfLetter(){
        $model=new Refconfirm();
        $session = Yii::$app->session;
        $us_id=$session->get('us_id');
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $let_Id = $data['id'];
            $users = array();
            $role=Users::RolesArray();
            foreach (Users::find()->select(['us_id','us_fname','us_lname','us_role'])->where(['NOT IN','us_id',$us_id])->all() as $key=>$value)
            {
                $users[$value->us_id] = $value->us_fname.' '.$value->us_lname.'('.$role[$value->us_role].')';
            }
            return $this->renderAjax('_formRefconf', [
                'model' => $model,
                'users'=>$users,
                'let_Id'=>$let_Id,
            ]);
        }
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post()))
            {
                $FindUsers = Users::find()->select(['us_id'])->where(['IN','us_id',$model->refconf_us_FK])->all();
                $letter = $this->findModel($model->refconf_let_FK);
                $model1= new Letters();
                foreach ($FindUsers as $iValRef){
                    $referall=new Refconfirm();
                    $referall->refconf_sender_FK=$us_id;
                    $referall->refconf_us_FK=$iValRef->us_id;
                    $referall->refconf_let_FK=$model->refconf_let_FK;
                    $referall->refconf_readstate=0;
                    $referall->refconf_date=strtotime(date('Y-m-d G:i:s'));
                    $referall->save();
                }
                $model1->letlog('Referral', $us_id, $model->refconf_let_FK, $letter->let_NumberSys);
                $letter->let_State=0;
                $letter->let_refconf=1;
                $letter->let_refconf_state=1;
                $letter->update();
                return $this->redirect(['index']);
            }
        }
    }

    public function actionTest()
    {
        $let_Id=3;
        $sig=ArrayHelper::getColumn(Signature::find()->where(['sig_let_id'=>$let_Id])->all(),'sig_us_id');
        echo implode(',',$sig);
    }




    //ایجاد شماره نامه
    public function numletGenrator()
    {
        $str = Letters::find()->orderBy(['let_Id' => SORT_DESC])->one();
        $y2 = Jdf::jdate('y', '', '', '', 'en');
        if ($str) {
            $y = explode('/', $str->let_NumberSys);
            return ($y[0] == $y2) ? $y[0] . "/" . ($y[1] + 1) : $y2 . '/' . '1000';
        } else {
            return $y2 . '/' . '1000';
        }
    }
    // تبدیل تاریخ به عدد و فرمت تاریخ

    public function changeDate($str, $type = '')
    {
        if ($type == 'str') {
            $t = explode('/', $str);
            return strtotime(Jdf::jalali_to_gregorian($t[0], $t[1], $t[2], '/'));
        } elseif ($type == 'date') {
            $t = explode('/', $str);
            return Jdf::jalali_to_gregorian($t[0], $t[1], $t[2], '/');
        }
    }
    // تبدیل اعداد از فارسی به انگلیسی

    public function cEnToFa($str)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        return str_replace($english, $persian, $str);
    }
      // حذف پیوست
    public function actionDeleteAttach()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();
            $at_Id = $data['id'];
            $let_Id = $data['id2'];
            $at = Attaches::find()->where(['at_Id' => $at_Id])->all();
            foreach ($at as $user) {
                unlink($user->at_Url);
                $user->delete();
            }
            $letter = Attaches::find()->where(['at_Letters_FK' => $let_Id])->count();
            if ($letter < 1) {
                $model = $this->findModel($let_Id);
                $model->let_AttachType = 0;
                $model->update();
            }
            echo $letter;
        }
    }
}
