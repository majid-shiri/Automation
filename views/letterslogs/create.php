<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letterslogs */

$this->title = 'Create Letterslogs';
$this->params['breadcrumbs'][] = ['label' => 'Letterslogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letterslogs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
