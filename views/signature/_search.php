<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SignatureSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="signature-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'sig_id') ?>

    <?= $form->field($model, 'sig_us_id') ?>

    <?= $form->field($model, 'sig_let_id') ?>

    <?= $form->field($model, 'sig_state') ?>

    <?= $form->field($model, 'sig_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
