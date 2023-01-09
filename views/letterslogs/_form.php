<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Letterslogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letterslogs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'let_log_Category')->textInput() ?>

    <?= $form->field($model, 'let_log_us_FK')->textInput() ?>

    <?= $form->field($model, 'let_log_let_FK')->textInput() ?>

    <?= $form->field($model, 'let_log_Date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
