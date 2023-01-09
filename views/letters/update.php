<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = 'Update Letters: ' . $model->let_Id;
$this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->let_Id, 'url' => ['view', 'let_Id' => $model->let_Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="letters-update">
    <?= $this->render('_form', [
        'model' => $model,
        'attach' =>$attach,
        'cop'=>$cop,
        'userpermit'=>$userpermit,
        'sigs'=>$sigs,
    ]) ?>

</div>
