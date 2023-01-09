<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'us_id') ?>

    <?= $form->field($model, 'us_username') ?>

    <?= $form->field($model, 'us_password') ?>

    <?= $form->field($model, 'us_fname') ?>

    <?= $form->field($model, 'us_lname') ?>

    <?php // echo $form->field($model, 'us_apsnelcode') ?>

    <?php // echo $form->field($model, 'us_gender') ?>

    <?php // echo $form->field($model, 'us_online') ?>

    <?php // echo $form->field($model, 'us_status') ?>

    <?php // echo $form->field($model, 'us_nickname') ?>

    <?php // echo $form->field($model, 'us_mobile') ?>

    <?php // echo $form->field($model, 'us_phone') ?>

    <?php // echo $form->field($model, 'us_email') ?>

    <?php // echo $form->field($model, 'us_role') ?>

    <?php // echo $form->field($model, 'us_pic') ?>

    <?php // echo $form->field($model, 'us_created_at') ?>

    <?php // echo $form->field($model, 'us_updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
