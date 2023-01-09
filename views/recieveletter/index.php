<?php

use hoomanMirghasemi\jdf\Jdf;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VwRecieveletterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
$dataProvider->pagination->pageSize = 10;
$script = <<<JS
$(".cl_add_draft").click(function() {
    $("#viewletter_modal_box").empty();
     $.pjax.reload({container:'#recieveletter-index',async:false});
})
JS;
$this->registerJs($script);
?>

    <div class="vw-recieveletter-index">

        <h1>ارجاعی ها</h1>

        <?php Pjax::begin(['id' => 'recieveletter-index', 'timeout' => false]); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <div class="card shadow mb-4">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'condensed' => true,
                'responsiveWrap' => true,
                'rowOptions' => function ($model, $key, $index, $gird) {
                    if ($model->ref_readstate == 0) {
                        return ['style' => 'color: black;'];
                    }
                    if ($model->ref_readstate == 1) {
                        return ['style' => 'filter: opacity(0.7);'];
                    }
                },
                'layout' => "{toolbar}{items}{pager}",
                'pager' => [
                    'options' => ['class' => 'pagination'],   // set clas name used in ui list of pagination
                    'prevPageLabel' => 'قبلی',   // Set the label for the "previous" page button
                    'nextPageLabel' => 'بعدی',   // Set the label for the "next" page button
                    'nextPageCssClass' => 'next',    // Set CSS class for the "next" page button
                    'prevPageCssClass' => 'prev',    // Set CSS class for the "previous" page button
                    'maxButtonCount' => 10,    // Set maximum number of page buttons that can be displayed
                ],
                'toolbar' => [
                    '{toggleData}',
                ],
                'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
                // set export properties
                'export' => [
                    'fontAwesome' => true
                ],
                'bordered' => true,
                'striped' => true,
                'resizableColumns' => false,
                'responsive' => true,
                'hover' => true,

                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn',
                        'header' => 'ردیف',
                    ],

                    'let_Subject',
                    ['attribute' => 'let_Date',
                        'filter' => false,
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return Jdf::jdate(' Y-m-d', $data->let_Date);
                        }],
                    'FullNameSender',
                    //'let_Sender:ntext',
                    'let_NumberIn',
                    'let_NumberSys',
                    [
                        'class' => 'kartik\grid\EnumColumn',
                        'attribute' => 'let_Type',
                        'enum' => [
                            '1' => 'وارده', '2' => 'صادره', '3' => 'داخلی',
                        ],
                        'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                            '1' => 'وارده', '2' => 'صادره', '3' => 'داخلی',
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\EnumColumn',
                        'attribute' => 'let_ActionType',
                        'enum' => [
                            '1' => 'عادی', '2' => 'فوری', '3' => 'خیلی فوری ', '4' => 'آنی'
                        ],
                        'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                            '1' => 'عادی', '2' => 'فوری', '3' => 'خیلی فوری ', '4' => 'آنی'
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\EnumColumn',
                        'attribute' => 'let_SecurityType',
                        'enum' => [
                            '1' => 'عادی ', '2' => 'محرمانه', '3' => 'خیلی محرمانه', '4' => 'سری', '5' => 'به کلی سری'
                        ],
                        'filter' => [
                            '1' => 'عادی ', '2' => 'محرمانه', '3' => 'خیلی محرمانه', '4' => 'سری', '5' => 'به کلی سری'
                        ],
                    ],
                    //'let_State',
                    //'let_Referral',
                    //'let_ReplayType',
                    //'let_FollowUpType',
                    //'let_AttachType',
                    //'let_CopiesType',
                    //'let_ParaffType',
                    //'let_ArchiveType',
                    ['attribute' => 'let_ResDateType',
                        'class' => '\kartik\grid\BooleanColumn',

                        'trueLabel' => 'دارد',
                        'falseLabel' => 'ندارد'
                    ],
                    ['attribute' => 'let_ResDate',
                        'filter' => false,
                        'noWrap' => true,
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            if ($data->let_ResDate != 0) {
                                return Jdf::jdate(' Y-m-d', $data->let_ResDate);
                            } else {
                                return '-----';
                            }
                        }],
                    //'let_Create_at',
                    //'let_Edit_at',
                    //'let_us_FK',

//            'FullNameReciever',
                    //'ref_Id',
                    //'ref_us_FK',
                    //'ref_sender_FK',
                    //'ref_readstate',
                    ['attribute' => 'ref_date',
                        'noWrap' => true,
                        'filter' => false,
                        'mergeHeader' => true,
                        'value' => function ($data) {
                            return Jdf::jdate('  H:i:s  Y-m-d', $data->let_Create_at);
                        }],

                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'template' => '{show} {sing} {down} {Referral}',
                        'visibleButtons' => [
//                    'show'=> function($model){
//                        return $model->let_Type!= 1;
//                    },
                        ],
                        'header' => 'عملیات',
                        'noWrap' => true,
                        'buttons' => [
                            'show' => function ($url, $model) {
                                return '<i style="cursor: pointer;" class="fad fa-eye text-primary openr" data-usid="' . Yii::$app->session->get('us_id') . '" data-id="' . $model->let_Id . '" title="مشاهده" data-toggle="tooltip"></i> ';
                            },
                            'sing' => function ($url, $model) {
                                if (Yii::$app->session->get('permit_22') == 1) {
                                    return '<i style="cursor: pointer;" class="fas fa-signature text-primary sings" data-usid="' . Yii::$app->session->get('us_id') . '"  data-id="' . $model->let_Id . '" title="امضا" data-toggle="tooltip"></i> ';
                                } else {
                                    return '';
                                }
                            },
                            'down' => function ($url, $model) {
                                return '<i style="cursor: pointer;" class="far fa-paperclip text-primary"  data-id="' . $model->let_Id . '" title="پیوست ها" data-toggle="tooltip"></i> ';
                            },
                            'Referral'=> function($url,$model){
                                return '<i style="cursor: pointer;" class="fas fa-share text-primary referral" data-id="'.$model->let_Id.'" title="ارجاع" data-toggle="tooltip"></i> ';
                            },
                        ],
                    ],
                ],
            ]);
            $viewletter = Yii::$app->urlManager->createUrl(['letters/view-letter']);
            $signsletter = Yii::$app->urlManager->createUrl(['signature/sings']);

            ?>
        </div>
        <!--start View Modal Draft-->

        <!--End View Modal Draft-->
        <?php

        $js = <<<JS
$('.openr').click(function(e) {
 let id =$(this).data("id");
 let usid =$(this).data("usid");
 NProgress.start();
     $.post('$viewletter',{id:id,reads:1,usid:usid},function(data) {
       $("#viewletter_modal").modal().show().find("#viewletter_modal_box").html(data);
        NProgress.done();
        });
});
$('.sings').click(function(e) {
 let id =$(this).data("id");
 let usid =$(this).data("usid");
 const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-primary',
    cancelButton: 'btn btn-secondary'
  },
  buttonsStyling: false
});
 const Toast = Swal.mixin({
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
swalWithBootstrapButtons.fire({
  title: '',
  text: "آیا نامه مورد نظر امضا شود؟",
  icon: 'question',
  showCancelButton: true,
  confirmButtonText: 'تایید',
  cancelButtonText: 'انصراف',
}).then((result) => {
  if (result.isConfirmed) {
    $.post( "$signsletter", {id:id , usid: usid })
      .done(function(data) {
        if(data==1){
           Toast.fire({
  icon: 'success',
  text: 'نامه مورد نظر امضا شد'
}); 
        }else{
           Toast.fire({
  icon: 'warning',
  text: 'این نامه را قبلا امضا کرده اید'
}); 
        }

      });
  }
  });
});

$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
JS;
        $this->registerJs($js);
        ?>

    </div>
    <div class="modal fade" id="viewletter_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"
                            data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="viewletter_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="attachletter_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"
                            data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="attachletter_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php Pjax::end(); ?>