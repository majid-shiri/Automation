<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */

$this->title = 'Update Signature: ' . $model->sig_id;
$this->params['breadcrumbs'][] = ['label' => 'Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sig_id, 'url' => ['view', 'sig_id' => $model->sig_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="signature-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
