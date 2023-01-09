<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LetterslogsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="letterslogs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'let_log_Id') ?>

    <?= $form->field($model, 'let_log_Category') ?>

    <?= $form->field($model, 'let_log_us_FK') ?>

    <?= $form->field($model, 'let_log_let_FK') ?>

    <?= $form->field($model, 'let_log_Date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
