<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VwRecieveletter */

$this->title = 'Create Vw Recieveletter';
$this->params['breadcrumbs'][] = ['label' => 'Vw Recieveletters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vw-recieveletter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
