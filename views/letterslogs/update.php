<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letterslogs */

$this->title = 'Update Letterslogs: ' . $model->let_log_Id;
$this->params['breadcrumbs'][] = ['label' => 'Letterslogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->let_log_Id, 'url' => ['view', 'let_log_Id' => $model->let_log_Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="letterslogs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
