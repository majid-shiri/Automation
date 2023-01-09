<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VwRecieveletter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vw-recieveletter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'let_Id')->textInput() ?>

    <?= $form->field($model, 'let_Subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'let_Abstract')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'let_Text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'let_Date')->textInput() ?>

    <?= $form->field($model, 'let_Recipient')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'let_Sender')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'let_NumberIn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'let_NumberSys')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'let_Type')->textInput() ?>

    <?= $form->field($model, 'let_ActionType')->textInput() ?>

    <?= $form->field($model, 'let_SecurityType')->textInput() ?>

    <?= $form->field($model, 'let_State')->textInput() ?>

    <?= $form->field($model, 'let_Referral')->textInput() ?>

    <?= $form->field($model, 'let_ReplayType')->textInput() ?>

    <?= $form->field($model, 'let_FollowUpType')->textInput() ?>

    <?= $form->field($model, 'let_AttachType')->textInput() ?>

    <?= $form->field($model, 'let_CopiesType')->textInput() ?>

    <?= $form->field($model, 'let_ParaffType')->textInput() ?>

    <?= $form->field($model, 'let_ArchiveType')->textInput() ?>

    <?= $form->field($model, 'let_ResDateType')->textInput() ?>

    <?= $form->field($model, 'let_ResDate')->textInput() ?>

    <?= $form->field($model, 'let_Create_at')->textInput() ?>

    <?= $form->field($model, 'let_Edit_at')->textInput() ?>

    <?= $form->field($model, 'let_us_FK')->textInput() ?>

    <?= $form->field($model, 'FullNameSender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FullNameReciever')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_Id')->textInput() ?>

    <?= $form->field($model, 'ref_us_FK')->textInput() ?>

    <?= $form->field($model, 'ref_sender_FK')->textInput() ?>

    <?= $form->field($model, 'ref_readstate')->textInput() ?>

    <?= $form->field($model, 'ref_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
