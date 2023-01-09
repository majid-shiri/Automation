<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VwRecieveletterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-recieveletter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'let_Id') ?>

    <?= $form->field($model, 'let_Subject') ?>

    <?= $form->field($model, 'let_Abstract') ?>

    <?= $form->field($model, 'let_Text') ?>

    <?= $form->field($model, 'let_Date') ?>

    <?php // echo $form->field($model, 'let_Recipient') ?>

    <?php // echo $form->field($model, 'let_Sender') ?>

    <?php // echo $form->field($model, 'let_NumberIn') ?>

    <?php // echo $form->field($model, 'let_NumberSys') ?>

    <?php // echo $form->field($model, 'let_Type') ?>

    <?php // echo $form->field($model, 'let_ActionType') ?>

    <?php // echo $form->field($model, 'let_SecurityType') ?>

    <?php // echo $form->field($model, 'let_State') ?>

    <?php // echo $form->field($model, 'let_Referral') ?>

    <?php // echo $form->field($model, 'let_ReplayType') ?>

    <?php // echo $form->field($model, 'let_FollowUpType') ?>

    <?php // echo $form->field($model, 'let_AttachType') ?>

    <?php // echo $form->field($model, 'let_CopiesType') ?>

    <?php // echo $form->field($model, 'let_ParaffType') ?>

    <?php // echo $form->field($model, 'let_ArchiveType') ?>

    <?php // echo $form->field($model, 'let_ResDateType') ?>

    <?php // echo $form->field($model, 'let_ResDate') ?>

    <?php // echo $form->field($model, 'let_Create_at') ?>

    <?php // echo $form->field($model, 'let_Edit_at') ?>

    <?php // echo $form->field($model, 'let_us_FK') ?>

    <?php // echo $form->field($model, 'FullNameSender') ?>

    <?php // echo $form->field($model, 'FullNameReciever') ?>

    <?php // echo $form->field($model, 'ref_Id') ?>

    <?php // echo $form->field($model, 'ref_us_FK') ?>

    <?php // echo $form->field($model, 'ref_sender_FK') ?>

    <?php // echo $form->field($model, 'ref_readstate') ?>

    <?php // echo $form->field($model, 'ref_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
