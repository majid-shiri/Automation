<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letterslogs */

$this->title = $model->let_log_Id;
$this->params['breadcrumbs'][] = ['label' => 'Letterslogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="letterslogs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'let_log_Id' => $model->let_log_Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'let_log_Id' => $model->let_log_Id], [
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
            'let_log_Id',
            'let_log_Category',
            'let_log_us_FK',
            'let_log_let_FK',
            'let_log_Date',
        ],
    ]) ?>

</div>
