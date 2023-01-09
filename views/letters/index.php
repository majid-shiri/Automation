<?php

use hoomanMirghasemi\jdf\Jdf;
use liyunfang\contextmenu\SerialColumn;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LettersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::$app->name;
$dataProvider->pagination->pageSize=10;
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$script = <<<JS
$(".cl_add_draft").click(function() {
  
    $("#add_draft_modal_box").empty();
    $("#viewletter_modal_box").empty();
    // $("#add_attach_box").empty();
    //  $("#sending_box").empty();
    
})

JS;
$this->registerJs($script);

?>
<div class="letters-index">

    <h1>پیشنویس ها</h1>
    <p>
        <?= Html::button('ایجاد پیش نویس', ['class' => 'btn btn-primary','id'=>'add_draft']) ?>
    </p>
    <!--start Add Modal Draft-->
    <div class="modal fade" id="add_draft_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"  data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="add_draft_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Add Modal Draft-->


    <!--start View Modal Draft-->
    <div class="modal fade" id="viewletter_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"  data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="viewletter_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End View Modal Draft-->

    <!--start Referral Modal Draft-->
    <div class="modal fade" id="Referralletter_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"  data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="Referralletter_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Referral Modal Draft-->


    <!--start ReferralConfirm Modal Draft-->
    <div class="modal fade" id="Referralconfirmletter_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header " style="background-color: whitesmoke">
                    <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"  data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div id="Referralconfirmletter_modal_box">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End ReferralConfirm Modal Draft-->


    <?php Pjax::begin(['id'=>'letters-index','timeout'=>false]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="card shadow mb-4">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'layout' => "{toolbar}{items}{pager}",
        'pager' => [
            'options'=>['class'=>'pagination','style'=>'background: rgba(255,255,255,0.902);'],   // set clas name used in ui list of pagination
            'prevPageLabel' => 'قبلی',   // Set the label for the "previous" page button
            'nextPageLabel' => 'بعدی',   // Set the label for the "next" page button
            'nextPageCssClass'=>'next',    // Set CSS class for the "next" page button
            'prevPageCssClass'=>'prev',    // Set CSS class for the "previous" page button
            'maxButtonCount'=>10,    // Set maximum number of page buttons that can be displayed
        ],
        'pjax' => true,
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
        'resizableColumns'=>false,
        'responsive' => true,
        'hover' => true,
        'condensed' =>true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',
                'header' => 'ردیف',
            ],
//            'let_Id',
            'let_Subject',
//            'let_Abstract',
//            'let_Text:ntext',
            'let_Sender',
//            'let_Recipient',
            [
                'format' => 'raw',
                'attribute' => 'let_Recipient',
                'value' => function($model) {
                    return  $ret = \yii\helpers\StringHelper::truncateWords($model->let_Recipient, 5, '...', true);
                }
            ],
//        return strlen($data->let_Recipient) > 20 ?  ". . ." : $data->let_Recipient;
            'let_NumberIn',

            ['attribute' =>  'let_Date',
                'filter'=>false,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    return Jdf::jdate(' Y-m-d', $data->let_Date);
                }],
            //'let_NumberSys',
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'let_Type',
                'enum' => [
                    '1'=>'وارده','2'=>'صادره','3'=>'داخلی',
                ],
                'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    '1'=>'وارده','2'=>'صادره','3'=>'داخلی',
                ],
            ],
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'let_ActionType',
                'enum' => [
                    '1'=>'عادی','2'=>'فوری','3'=>'خیلی فوری ','4'=>'آنی'
                ],
                'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    '1'=>'عادی','2'=>'فوری','3'=>'خیلی فوری ','4'=>'آنی'
                ],
            ],
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' =>  'let_SecurityType',
                'enum' => [
                    '1'=>'عادی ','2'=>'محرمانه','3'=>'خیلی محرمانه','4'=>'سری','5'=>'به کلی سری'
                ],
                'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    '1'=>'عادی ','2'=>'محرمانه','3'=>'خیلی محرمانه','4'=>'سری','5'=>'به کلی سری'
                ],
            ],
            //'let_State',
            //'let_Referral',
            //'let_ReplayType',
            ['attribute' =>  'let_FollowUpType',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => 'دارد',
                'falseLabel' => 'ندارد'
            ],
            ['attribute' =>   'let_AttachType',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => 'دارد',
                'falseLabel' => 'ندارد'
            ],

             ['attribute' =>   'let_ArchiveType',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => 'دارد',
                'falseLabel' => 'ندارد'
            ],
            ['attribute' =>   'let_ResDateType',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => 'دارد',
                'falseLabel' => 'ندارد'
            ],
            ['attribute' =>    'let_ResDate',
                'filter'=>false,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    if ($data->let_ResDate != 0) {
                        return Jdf::jdate(' Y-m-d', $data->let_ResDate);
                    } else {
                        return '-----';
                    }
                }],
            ['attribute' => 'let_Create_at',
                'filter'=>false,
                'noWrap'=>true,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    return Jdf::jdate('  H:i:s  Y-m-d', $data->let_Create_at);
                }],
            ['attribute' =>   'let_Edit_at',
                'filter'=>false,
                'noWrap'=>true,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    if ($data->let_Edit_at != 0) {
                        return Jdf::jdate('  H:i:s  Y-m-d', $data->let_Edit_at);
                    } else {
                        return '-----';
                    }
                }],
            //'let_us_FK',

            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{show} {ReferralConfirm}{Referral} {update}  {delete} ',
                'visibleButtons'=>[
//                    'show'=> function($model){
//                        return $model->let_Type!= 1;
//                    },
                ],
                'header' => 'عملیات',
                'noWrap'=>true,
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fad fa-trash-alt text-primary" title="حذف" data-toggle="tooltip"></i>', ['delete', 'let_Id' => $model->let_Id,'let_numsys'=>$model->let_NumberSys], [
                            'class' => 'delete',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                                'pjax' => 0,
                                'title' => Yii::t('yii', 'Confirm?'),
                                'ok' => Yii::t('yii', 'Confirm'),
                                'cancel' => Yii::t('yii', 'Cancel'),
                            ],
                        ]);
                    },
                     'update' => function ($url, $model) {
                        return Html::a('<i class="fad fa-edit" title="ویرایش" data-toggle="tooltip"></i>', ['update', 'let_Id' => $model->let_Id], [
                        ]);
                    },
                    'show'=> function($url,$model){
                        return '<i style="cursor: pointer;" class="fad fa-eye text-primary openr" data-id="'.$model->let_Id.'" title="مشاهده" data-toggle="tooltip"></i> ';
                    },
                    'Referral'=> function($url,$model){
                        return '<i style="cursor: pointer;" class="fas fa-share text-primary referral" data-id="'.$model->let_Id.'" title="ارجاع" data-toggle="tooltip"></i> ';
                    },
                    'ReferralConfirm'=> function($url,$model){
                        return '<i style="cursor: pointer;" class="fal fa-share text-primary Referralconfirm" data-id="'.$model->let_Id.'" title="ارجاع جهت تائید" data-toggle="tooltip"></i> ';
                    },
                ]
            ],
        ],
    ]);?>
</div>

<?php
    $createLetter = Yii::$app->urlManager->createUrl(['letters/create']);
    $viewletter = Yii::$app->urlManager->createUrl(['letters/view-letter']);
    $updateletter = Yii::$app->urlManager->createUrl(['letters/update-ajax']);
    $Referralletter = Yii::$app->urlManager->createUrl(['letters/referral-letter']);
    $Refconfletter = Yii::$app->urlManager->createUrl(['letters/refconf-letter']);
    ?>
    <?php

    $js=<<<JS
$('#add_draft').click(function() {
     NProgress.start();
      var ok = true;
      $.post('$createLetter',{ok:ok},function(data) {
      
        $("#add_draft_modal").modal({focus: false}).show().find("#add_draft_modal_box").html(data);
         NProgress.done();
    });
});
$('.openr').click(function(e) {
 let id =$(this).data("id")
 NProgress.start();
     $.post('$viewletter',{id:id,reads:0},function(data) {
       $("#viewletter_modal").modal().show().find("#viewletter_modal_box").html(data);
        NProgress.done();
        });
});
$('.referral').click(function(e) {
 let id =$(this).data("id");
 NProgress.start();
     $.post('$Referralletter',{id:id},function(data) {
       $("#Referralletter_modal").modal().show().find("#Referralletter_modal_box").html(data);
        NProgress.done();
        });
});
$('.Referralconfirm').click(function(e) {
 let id =$(this).data("id");
 NProgress.start();
      $.post('$Refconfletter',{id:id},function(data) {
       $("#Referralconfirmletter_modal").modal().show().find("#Referralconfirmletter_modal_box").html(data);
        NProgress.done();
        });
});
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
JS;
$this->registerJs($js);
    ?>
    <?php Pjax::end(); ?>
</div>
