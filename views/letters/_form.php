<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\tabs\TabsX;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$script = <<<JS
$(document).off('submit','#letters-form form[data-pjax]');
$("#letters-form").on('pjax:beforeSend',function() {
    NProgress.start();
});

$('#letters-form').on('pjax:success',function() {
    
    history.pushState(null,'','/mana/letters');
     $.pjax.reload({container:'#letters-index',async:false});
    $(".cl_add_draft").trigger('click');
    NProgress.done();
});

JS;
$this->registerJs($script);
?>
<?php
$data=[];
$s2val=[];
$FollowUp = false;
$ArchiveType = false;
$ResDateType = false;
$ResDate = true;
$cop1='';
$s='';
if (!$model->isNewRecord) {
    ($model->let_FollowUpType == 1) ? $FollowUp = true : $FollowUp = false;
    ($model->let_ArchiveType == 1) ? $ArchiveType = true : $ArchiveType = false;
    if ($model->let_ResDateType == 1) {
        $ResDateType = true;
        $ResDate = false;
    } else {
        $ResDateType = false;
        $ResDate = true;
    }
    $cop1=$cop;
    $s=$sigs;
    if ($model->let_Type!=1){
        $sigsJS=<<<JS
$('#sigs').val('$s').trigger('change');
JS;
$this->registerJs($sigsJS);
    }
}
?>
<!--start View Modal Draft-->

<div class="modal fade" id="zoom_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header " style="background-color: whitesmoke">
                <button type="button" class="close cl_add_draft" style="float: right;opacity: 1 !important;"
                        data-dismiss="modal" aria-hidden="true"><i class="fal fa-times"></i></button>
            </div>
            <div class="modal-body">
                <div id="zoom_modal_box">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End View Modal Draft-->
<div class="letters-form" style="">

    <?php Pjax::begin(['id' => 'letters-form', 'timeout' => false]); ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?=
    TabsX::widget([
        'items' => [
            [
                'label' => '<i class="fad fa-info-circle"></i> جزئیات',
                'content' => '<div class="row">
        <div class="col-md-3">' . $form->field($model, 'let_Subject')->textInput(['maxlength' => true]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_Abstract')->textInput(['maxlength' => true]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_Type')->dropDownList(['' => 'نوع نامه', '1' => 'وارده', '2' => 'صادره', '3' => 'داخلی'], ['onchange' => 'typelet($(this));']) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_Date')->textInput(['class' => 'form-control date', 'autocomplete' => "off"]) . '</div>
    </div>
    <div class="row">
        <div class="col-md-3">' . $form->field($model, 'let_Sender')->textarea(['maxlength' => true]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_Recipient')->textarea(['maxlength' => true]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_ActionType')->dropDownList(['' => 'نوع اقدام', '1' => 'عادی', '2' => 'فوری', '3' => 'خیلی فوری ', '4' => 'آنی']) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_SecurityType')->dropDownList(['' => 'نوع حساسیت', '1' => 'عادی ', '2' => 'محرمانه', '3' => 'خیلی محرمانه', '4' => 'سری', '5' => 'به کلی سری']) . '</div>
    </div>
    <div class="row">
        <div class="col-md-3 input-group">
            <div class="col-md-4">' . $form->field($model, 'let_FollowUpType')->checkbox([
                        'label' => 'پیگیری',
                        'id' => 'FollowUp',
                        'checked' => $FollowUp,
                        'uncheck' => null,
                        'style' => 'text-align: center !important;vertical-align: middle !important'
                    ]) . '</div>
            <div class="col-md-4">' . $form->field($model, 'let_ArchiveType',['inputOptions'=>['class'=>"form-control"]])->checkbox([
                        'label' => 'بایگانی',
                        'id' => 'archive',
                        'checked' => $ArchiveType,
                        'uncheck' => null,
                        'style' => 'text-align: center !important;vertical-align: middle !important'
                    ]) . '</div>
            <div class="col-md-4">' . $form->field($model, 'let_ResDateType')->checkbox([
                        'label' => 'مهلت پاسخ',
                        'id' => 'ResDate',
                        'checked' => $ResDateType,
                        'uncheck' => null,
                        'style' => 'text-align: center !important;vertical-align: middle !important'
                    ]) . '</div>
        </div>
        <div class="col-md-3">' . $form->field($model, 'let_ResDate')->textInput(['class' => 'form-control date', 'autocomplete' => "off", 'id' => 'let_ResDate', 'disabled' => $ResDate]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'let_NumberIn', ['inputOptions' => ['id' => 'let_NumberIn', 'disabled' => 'true']])->textInput(['class' => 'form-control', 'autocomplete' => "off"]) . '</div>
        <div class="col-md-3">' . $form->field($model, 'Copies' ,['inputOptions'=>['class'=>"form-control",'multiple'=>"multiple"]])->widget(Select2::className(), [
                        'language' => 'fa',
                        'data' => $cop1,
                        'options' => ['dir'=>'rtl','multiple' => true,'placeholder' => 'رونوشت ها'],
                        'theme' => Select2::THEME_KRAJEE,
                        'pluginOptions' => [
                            'tags' => true,
                            'allowClear'=>true,
                            ' selectOnClose'=>true,
                        ],
                    ]) . '</div>
        <div class="col-md-3">
         <div class="form-group"> <label>امضا کنندگان</label>
          <select class="form-control select2 select2-hidden-accessible" id="sigs" name="sigs[]"  style="width: 100%;" tabindex="-1" aria-hidden="true" multiple>
                  '.$userpermit.'
                </select> 
             </div>
</div>
    </div>
    <div class="row">
     <div class="col-md-12">' . $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true,'class'=>'filepond']).'</div>
</div>
    ',
            ],
            [
                'label' => '<i class="fad fa-quote-right"></i> متن نامه',
                'content' => $form->field($model, 'let_Text')->textarea(['rows' => 6, 'id' => 'editor']),
            ],
        ],
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'bordered' => true,
        'encodeLabels' => false
    ]); ?>
    <input type="number" value="<?=$model->let_AttachType?>" hidden id="attachtype"/>
    <div class="row" id="attaches">
        <div class="col-md-12">
            <?php
            if (!$model->isNewRecord) {
                if (!empty($attach)) {
                    echo 'پیوست ها:</br>';
                    echo '  <div class="section section-muted section-small">
                <div class="container">
                    <div class="row">';
                    foreach ($attach as $iVal) {
                        $url = '../' . $iVal->at_Url;
                        ?>
                        <div class="col" id="attach<?= $iVal->at_Id ?>">
                            <div class=" col-xl-2 col-md-2 mb-2">
                                <div class="card border-left-primary" style="width: 18rem;">
                                    <?= '<embed src="' . $url . '" width="100%" height="100%"/>' ?>
                                    <div class="inline glass-mj-content">
                                        <i class=" fas fa-eye btn-outline-primary zoom"  data-src="<?= $url ?>" style="padding: 10px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"></i>
                                        <i class="fas fa-trash btn-outline-danger delattach" style="padding: 13px" data-id="<?= $iVal->at_Id ?>" data-id2="<?= $model->let_Id ?>"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    echo ' </div>
                </div>
            </div>';
                }
            }
            ?>

        </div>
    </div>

    <div class="col-md-12 modal-footer">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'ایجاد پیشنویس' : 'به روزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php

    $deleteattach = Yii::$app->urlManager->createUrl(['letters/delete-attach']);
    $script = <<<JS
$(function ()
    {
        $('#letters-let_recipient').keyup(function (e){
            if(e.keyCode == 13){
                var curr = getCaret(this);
                var val = $(this).val();
                var end = val.length;

                $(this).val( val.substr(0, curr) + '<br>' + val.substr(curr, end));
            }

        })
    });

    function getCaret(el) { 
        if (el.selectionStart) { 
            return el.selectionStart; 
        }
        else if (document.selection) { 
            el.focus(); 

            var r = document.selection.createRange(); 
            if (r == null) { 
                return 0; 
            } 

            var re = el.createTextRange(), 
            rc = re.duplicate(); 
            re.moveToBookmark(r.getBookmark()); 
            rc.setEndPoint('EndToStart', re); 

            return rc.text.length; 
        }  
        return 0; 
    }



ClassicEditor
				.create( document.querySelector( '#editor' ), {
					
				toolbar: {
					items: [
						'pageBreak',
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'horizontalLine',
						'|',
						'alignment',
						'fontFamily',
						'fontSize',
						'fontColor',
						'fontBackgroundColor',
						'highlight',
						'|',
						'underline',
						'specialCharacters',
						'strikethrough',
						'subscript',
						'superscript',
						'|',
						'blockQuote',
						'findAndReplace',
						'insertTable',
						'undo',
						'redo'
					]
				},
				language: 'fa',
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
					licenseKey: '',
					
					
					
				} )
				.then( editor => {
					window.editor = editor;
				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: anfp5izaqg4-s3iz0pub9nxp' );
					console.error( error );
				} );
$(document).ready(function() {
    $(".date").pDatepicker(
        {
    observer: true,
    format: 'YYYY/MM/DD',
    initialValue: false,
    responsive: true,
    autoClose: true,
    toolbox:{
        calendarSwitch:{
            enabled: false
        }
    }
}
    );
  });
  $("#ResDate").on('change', function() {
      let input = document.querySelector("#let_ResDate");
    if($(this).is(":checked")){
        input.disabled = false;
    }else {
        $("#let_ResDate").val(null);
        input.disabled = true;
    }
  });
  $('.zoom').click(function() {
    let url =$(this).data("src");
    let data='<embed src="'+url+'" width="100%" height="500px" style="margin: 15px;"/>';
     $("#zoom_modal").modal().show().find("#zoom_modal_box").html(data);
  });
  $('.delattach').click(function() {
    let id=$(this).data("id");
    let id2=$(this).data("id2");
    NProgress.start();
    const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-danger',
    cancelButton: 'btn btn-secondary'
  },
  buttonsStyling: false
});
swalWithBootstrapButtons.fire({
   title: 'توجه!!',
   text: "آیا  به حذف این پیوست مطمئنید؟",
  icon: 'warning',
  showCancelButton: true,
   confirmButtonText: 'بله ،حذف شود',
   cancelButtonText: 'نه دستم خورد',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
       $.post('$deleteattach',{id:id,id2:id2},function(data) {
         if(data<1){
             $('#attaches').empty();
             $('#attachtype').val(0);
         }else{
             $('#attach'+id).empty();
         }
         swalWithBootstrapButtons.fire(
      'Deleted!',
     'پیوست با موفقیت حذف شد',
      'success'
    );
        NProgress.done();
        });
    
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      '.درخواست حذف کنسل شد',
      'info'
    );
    NProgress.done();
  }
});
    
    
    
    
    
  });
  $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
});
 $('#sigs').select2({
closeOnSelect: false,
maximumSelectionLength: 2,
});
    $('[data-toggle = "tooltip"]').tooltip();
  $('input:file').shieldUpload();
  function typelet(item)
    {
             let input = document.querySelector("#let_NumberIn");
             
        if(item.val() == 1) {
                       input.disabled = false;
                        $("#sigs").val(null).trigger('change');
                    }else{
                    $("#let_NumberIn").val(null);
                    input.disabled = true;
                    }
    }
JS;

    $this->registerJs($script);
    ?>
    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
