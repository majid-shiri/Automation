<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use hoomanMirghasemi\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;
$session = \Yii::$app->session;
$this->params['breadcrumbs'][] = $this->title;
$RolesArray=$model->RolesArray();

?>
<?php
$script = <<<JS

JS;
$this->registerJs($script);

?>
<div class="users-index">

    <h3><?= Html::encode('کاربران سیستم') ?></h3>
    <?php
    if($session->get('permit_41')==1){
        ?>
    <p>
        <?= Html::button('ایجاد کاربر', ['class' => 'btn btn-primary', 'data' => ['toggle' => 'modal', 'target' => '#createusers',],]) ?>
    </p>
    <?php
    }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="createusers" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?= $this->render('create', ['model' => $model]); ?>
                </div>
            </div>
        </div>
    </div>

    <?php Pjax::begin(['id' => 'user-index', 'timeout' => false,  'enablePushState' => false,]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <div class="card shadow mb-4">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'pjax' => true,
        'toolbar' => [
            '{export}',
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
        'panel' => false,

        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',
                'header' => 'ردیف',],
//            'us_id',
            'us_username',
            ['attribute' => 'us_password',
                'value' => function ($data) {
                    return base64_decode($data->us_password);
                }],
            'us_fname',
            'us_lname',
            'us_apsnelcode',
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'us_gender',
                'enum' => [
                    '0' => 'زن',
                    '1' => 'مرد',
                ],
                'filter' => [  // will override the grid column filter (i.e. `loadEnumAsFilter` will be parsed as `false`)
                    '0' => 'زن',
                    '1' => 'مرد',
                ],
            ],
//            'us_online',
            ['attribute' => 'us_status',
                'class' => '\kartik\grid\BooleanColumn',
                'trueLabel' => 'فعال',
                'falseLabel' => 'غیرفعال'
            ],
            'us_nickname',
            'us_mobile',
            'us_phone',
            'us_email:email',
            [
                'class' => 'kartik\grid\EnumColumn',
                'attribute' => 'us_role',
                'enum' => $RolesArray
                ,
                'filter' => $RolesArray,
            ],
//            ['attribute' => 'us_pic',
//                'mergeHeader'=>true,
//                'filter'=>false
//            ],
            ['attribute' => 'us_created_at',
                'filter'=>false,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    return Jdf::jdate(' Y-m-d H:i:s ', $data->us_created_at);
                }],
            ['attribute' => 'us_updated_at',
                'filter'=>false,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    if ($data->us_updated_at != 0) {
                        return Jdf::jdate(' Y-m-d H:i:s', $data->us_updated_at);
                    } else {
                        return '-----';
                    }
                }],


            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{permits} {update} {delete}',
                'header' => 'عملیات',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fad fa-trash-alt" title="حذف کاربر" data-toggle="tooltip"></i>', ['delete', 'us_id' => $model->us_id], [
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
                        return Html::a('<i class="fad fa-edit" title="بروزرسانی" data-toggle="tooltip"></i>', ['update', 'us_id' => $model->us_id], [
                        ]);
                    },
                   'permits'=> function($url,$model){
                        return '<i style="cursor: pointer;" class="far fa-user-cog text-primary pus" data-id="'.$model->us_id.'" data-name="'.$model->us_fname.' '.$model->us_lname.'" title="دسترسی ها" data-toggle="tooltip"></i> ';
                    },
                ]
            ]

        ],
    ]);
    ?>
    </div>
    <?php Pjax::end(); ?>



    <div class="modal fade" id="pertmits_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
         data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div id="pertmits_modal_box">
                        <h5>تنظیمات دسترسی کاربر:<strong id="pus_name"></strong></h5>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pus-10" role="tab" aria-controls="pills-home" aria-selected="true">پیش نویس ها</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pus-20" role="tab" aria-controls="pills-profile" aria-selected="false">دریافتی</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pus-30" role="tab" aria-controls="pills-contact" aria-selected="false">جهت تایید</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pus-40" role="tab" aria-controls="pills-contact" aria-selected="false">کاربران</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pus-50" role="tab" aria-controls="pills-contact" aria-selected="false">ارسالی</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pus-60" role="tab" aria-controls="pills-contact" aria-selected="false">پیگیری</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pus-10" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus10" checked="" >
                                            کلی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus11" class="pus10" checked="" >
                                            ایجاد
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus12" class="pus10" checked="" >
                                            مشاهده
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus13" class="pus10" checked="" >
                                            ارجاع
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus14" class="pus10" checked="" >
                                            ارجاع جهت تایید
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus15" class="pus10" checked="" >
                                            بروزرسانی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus16" class="pus10" checked="" >
                                            حذف
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus-20" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus20" checked="" >
                                            کلی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus21" class="pus20" checked="" >
                                            مشاهده
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus22" class="pus20" checked="" >
                                            امضا
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus23" class="pus20" checked="" >
                                            ارجاع
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus24" class="pus20" checked="" >
                                            پاسخ
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="">
                                            <input type="checkbox" id="pus25" class="pus20" checked="" >
                                            پاراف
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus-30" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus30" checked="" >
                                            کلی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus31" class="pus30" checked="" >
                                            مشاهده
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus32" class="pus30" checked="" >
                                            تایید/رد
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus33" class="pus30" checked="" >
                                            ارجاع
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus-40" role="tabpanel" aria-labelledby="pills-contact-tab">
                                <div class="card-body">
                                    <div class="form-check form-check-inline">
                                        <label>
                                            <input type="checkbox" id="pus40" checked="" >
                                            کلی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus41" class="pus40" checked="" >
                                            ایجاد
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus42" class="pus40" checked="" >
                                            تنظیم مجوز
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus43" class="pus40" checked="" >
                                            بروزرسانی
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label> <input type="checkbox" id="pus44" class="pus40" checked="" >
                                            حذف
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus-50" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                            <div class="tab-pane fade" id="pus-60" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                        </div>
                        <p class="text-primary">*منظور از کلی دسترسی به  آن بخش می باشد.</p>
                        <button id="sub-pus" type="button" class="btn btn-primary btn-sm" >بروزرسانی</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true" >انصراف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $PUS = Yii::$app->urlManager->createUrl(['users/permits']);
    $PUSUP=Yii::$app->urlManager->createUrl(['users/permits-update']);
    $script = <<<JS
 $('#canselz').click(function(){
       inputclear();
    });
$("#user-create").on('pjax:beforeSend',function(){
    NProgress.start();
});
$("#user-create").on('pjax:success',function(){ 
    $('#createusers').modal('hide');
    $.pjax.reload({container:'#user-index',async:false});
    inputclear();
     NProgress.done();
});
function inputclear() {
   $("#users-us_username").val(null);$("#users-us_password").val(null);$("#users-us_fname").val(null);       
            $("#users-us_lname").val(null); $("#users-us_apsnelcode").val(null);$("#users-us_gender").val(null);         
            $("#users-us_status").val(null);$("#users-us_nickname").val(null);$("#users-us_mobile").val(null);$("#users-us_phone").val(null);        
            $("#users-us_email").val(null);$("#users-us_role").val(null);$("#users-us_pic").val(null); 
}
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
$('.pus').click(function(e) {
 let id =$(this).data("id");
 let name =$(this).data("name");
 NProgress.start();
     $.post('$PUS',{id:id,name:name},function(data) {
         document.getElementById("pus_name").innerHTML=data.names;
      if(data.permit_10==1){document.getElementById("pus10").checked=(data.permit_10==1?true:!1);document.getElementById("pus11").checked=(data.permit_11==1?true:!1);document.getElementById("pus12").checked=(data.permit_12==1?true:!1);document.getElementById("pus13").checked=(data.permit_13==1?true:!1);document.getElementById("pus14").checked=(data.permit_14==1?true:!1);document.getElementById("pus15").checked=(data.permit_15==1?true:!1);document.getElementById("pus16").checked=(data.permit_16==1?true:!1)}else{document.getElementById("pus10").checked=!1;document.getElementById("pus11").checked=!1;document.getElementById("pus11").disabled=!0;document.getElementById("pus12").checked=!1;document.getElementById("pus12").disabled=!0;document.getElementById("pus13").checked=!1;document.getElementById("pus13").disabled=!0;document.getElementById("pus14").checked=!1;document.getElementById("pus14").disabled=!0;document.getElementById("pus15").checked=!1;document.getElementById("pus15").disabled=!0;document.getElementById("pus16").checked=!1;document.getElementById("pus16").disabled=!0}
if(data.permit_20==1){document.getElementById("pus20").checked=(data.permit_20==1?true:!1);document.getElementById("pus21").checked=(data.permit_21==1?true:!1);document.getElementById("pus22").checked=(data.permit_22==1?true:!1);document.getElementById("pus23").checked=(data.permit_23==1?true:!1);document.getElementById("pus24").checked=(data.permit_24==1?true:!1);document.getElementById("pus25").checked=(data.permit_25==1?true:!1)}else{document.getElementById("pus20").checked=!1;document.getElementById("pus21").checked=!1;document.getElementById("pus21").disabled=!0;document.getElementById("pus22").checked=!1;document.getElementById("pus22").disabled=!0;document.getElementById("pus23").checked=!1;document.getElementById("pus23").disabled=!0;document.getElementById("pus24").checked=!1;document.getElementById("pus24").disabled=!0;document.getElementById("pus25").checked=!1;document.getElementById("pus25").disabled=!0}
if(data.permit_30==1){document.getElementById("pus30").checked=(data.permit_30==1?true:!1);document.getElementById("pus31").checked=(data.permit_31==1?true:!1);document.getElementById("pus32").checked=(data.permit_32==1?true:!1);document.getElementById("pus33").checked=(data.permit_33==1?true:!1)}else{document.getElementById("pus30").checked=!1;document.getElementById("pus31").checked=!1;document.getElementById("pus31").disabled=!0;document.getElementById("pus32").checked=!1;document.getElementById("pus32").disabled=!0;document.getElementById("pus33").checked=!1;document.getElementById("pus33").disabled=!0}
if(data.permit_40==1){document.getElementById("pus40").checked=(data.permit_40==1?true:!1);document.getElementById("pus41").checked=(data.permit_41==1?true:!1);document.getElementById("pus42").checked=(data.permit_42==1?true:!1);document.getElementById("pus43").checked=(data.permit_43==1?true:!1);document.getElementById("pus44").checked=(data.permit_44==1?true:!1)}else{document.getElementById("pus40").checked=!1;document.getElementById("pus41").checked=!1;document.getElementById("pus41").disabled=!0;document.getElementById("pus42").checked=!1;document.getElementById("pus42").disabled=!0;document.getElementById("pus43").checked=!1;document.getElementById("pus43").disabled=!0;document.getElementById("pus44").checked=!1;document.getElementById("pus44").disabled=!0}
      $('#sub-pus').attr("data-id",data.permit_us_id);
      $('#sub-pus').attr("data-name",data.names);
       $("#pertmits_modal").modal().show();
        NProgress.done();
        });
});
$('#sub-pus').click(function(e) {
    let id=$('#sub-pus').attr("data-id");
    var namec=$('#sub-pus').attr("data-name");
    const dat = [];
    let v=10,b=20,n=30,m=40;
    for(i=0;i<=21;i++){
        if(i<=6){
          dat[i]=(document.getElementById("pus"+v).checked?1:0);
          ++v;  
        }else if(i<=12){
            dat[i]=(document.getElementById("pus"+b).checked?1:0);
          ++b;
        }else if(i<=16){
            dat[i]=(document.getElementById("pus"+n).checked?1:0);
          ++n;
        }else if(i<=21){
            dat[i]=(document.getElementById("pus"+m).checked?1:0);
          ++m;
        }
    }
    dat[22]=id;
    $.post('$PUSUP',{data:dat},function(data) {
    var txt='مجوزهای کاربر: '+' '+namec+' '+'تغییر یافت';
    $("#pertmits_modal").modal('toggle');
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

Toast.fire({
  icon: 'success',
  text: txt
});

    });
});
$('#pus10').click(function() {
  if (this.checked) {
     $("input.pus10").removeAttr("disabled");
     $("input.pus10").prop( "checked", true );
  } else {
   $("input.pus10").attr("disabled", true);
   $("input.pus10").prop( "checked", false );
  }
});
$('#pus20').click(function() {
  if (this.checked) {
     $("input.pus20").removeAttr("disabled");
     $("input.pus20").prop( "checked", true );
  } else {
   $("input.pus20").attr("disabled", true);
   $("input.pus20").prop( "checked", false );
  }
});
$('#pus30').click(function() {
  if (this.checked) {
     $("input.pus30").removeAttr("disabled");
     $("input.pus30").prop( "checked", true );
  } else {
   $("input.pus30").attr("disabled", true);
   $("input.pus30").prop( "checked", false );
  }
});
$('#pus40').click(function() {
  if (this.checked) {
     $("input.pus40").removeAttr("disabled");
     $("input.pus40").prop( "checked", true );
  } else {
   $("input.pus40").attr("disabled", true);
   $("input.pus40").prop( "checked", false );
  }
});
JS;
    $this->registerJs($script);
    ?>
</div>
