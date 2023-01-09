<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Signature */

$this->title = $model->sig_id;
$this->params['breadcrumbs'][] = ['label' => 'Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="signature-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'sig_id' => $model->sig_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'sig_id' => $model->sig_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sig_id',
            'sig_us_id',
            'sig_let_id',
            'sig_state',
            'sig_date',
        ],
    ]) ?>

</div>
