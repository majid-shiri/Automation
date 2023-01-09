<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */

$RolesArray=$model->RolesArray();
?>
<div class="users-form">
    <?php $form = ActiveForm::begin(['options'=>['data-pjax'=>0,'enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-md-3"> <?= $form->field($model, 'us_username')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"> <?= $form->field($model, 'us_password')->passwordInput() ?></div>
        <div class="col-md-3"> <?= $form->field($model, 'us_fname')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_lname')->textInput(['maxlength' => true]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-3"><?= $form->field($model, 'us_nickname')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_apsnelcode')->textInput() ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_gender')->dropDownList(['' => 'جنسیت','1'=>'مرد','0'=>'زن']) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_status')->dropDownList(['' => 'وضعیت کاربر','1'=>'فعال','0'=>'غیر فعال']) ?></div>
    </div>
    <div class="row">

        <div class="col-md-3"><?= $form->field($model, 'us_mobile')->textInput() ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_phone')->textInput() ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_email')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-3"><?= $form->field($model, 'us_role')->dropDownList($RolesArray,['prompt'=>'مسئولیت ']) ?></div>

        <div class="<?=$model->isNewRecord? 'col-md' : 'col-md-3'?>">
            <input type="checkbox" id="signuser"/>
            <label for="signuser">آپلود امضا</label>
            <?= $form->field($model, 'imagesign')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*','id'=>'signus'],
            ]); ?>
        </div>
    </div>
    <div class="row ">

        <div class="col-md-12 modal-footer"> <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'ایجاد کاربر' : 'به روزرسانی', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= $model->isNewRecord ? Html::button('انصراف', ['class' => 'btn btn-secondary', 'data' => ['dismiss' => 'modal'],'id'=>'canselz']):'' ?>
            </div>
        </div>
    </div>
    <?php
    $si=<<<JS
  $("#signuser").on('change', function() {
      let input = document.querySelector(".field-signus");
    if($(this).is(":checked")){
        input.hidden = false;
    }else {
        $(".field-signus").val(null);
        input.hidden = true;
    }
  });
JS;
$this->registerJs($si);
    ?>
























    <?php ActiveForm::end(); ?>

</div>
