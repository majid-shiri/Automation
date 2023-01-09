<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VwRecieveletter */

$this->title = 'Update Vw Recieveletter: ' . $model->let_Id;
$this->params['breadcrumbs'][] = ['label' => 'Vw Recieveletters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->let_Id, 'url' => ['view', 'let_Id' => $model->let_Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vw-recieveletter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
