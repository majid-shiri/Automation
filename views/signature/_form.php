<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="signature-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sig_us_id')->textInput() ?>

    <?= $form->field($model, 'sig_let_id')->textInput() ?>

    <?= $form->field($model, 'sig_state')->textInput() ?>

    <?= $form->field($model, 'sig_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
