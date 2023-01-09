<?php
/* @var $this yii\web\View */

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $model app\models\Letters */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin(['id' => 'letters-form', 'timeout' => false]); ?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div>
<?= $form->field($model, 'refconf_us_FK' ,['inputOptions'=>['class'=>"form-control",'multiple'=>"multiple"]])->widget(Select2::className(), [
    'language' => 'fa',
    'data' => $users,
    'options' => ['dir'=>'rtl','multiple' => true,'placeholder' => 'Select states ...'],
    'theme' => Select2::THEME_KRAJEE,
    'pluginOptions' => [
    'tags' => false,
    'allowClear'=>true,
    ' selectOnClose'=>true,
    ],
    ])->label('تایید کنندگان') ?>
<?= $form->field($model, 'refconf_let_FK')->hiddenInput(['value'=>$let_Id])->label(false) ?>
</div>
<div class="col-md-12 modal-footer">
    <div class="form-group">
        <?= Html::submitButton( 'ارجاع جهت تایید',['class'=>'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
