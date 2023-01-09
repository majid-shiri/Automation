<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = $model->let_Id;
$this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="letters-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'let_Id' => $model->let_Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'let_Id' => $model->let_Id], [
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
            'let_Id',
            'let_Subject',
            'let_Abstract',
            'let_Text:ntext',
            'let_Date',
            'let_Recipient',
            'let_Sender',
            'let_NumberIn',
            'let_NumberSys',
            'let_Type',
            'let_ActionType',
            'let_SecurityType',
            'let_State',
            'let_Referral',
            'let_ReplayType',
            'let_FollowUpType',
            'let_AttachType',
            'let_CopiesType',
            'let_ParaffType',
            'let_ArchiveType',
            'let_ResDateType',
            'let_ResDate',
            'let_Create_at',
            'let_us_FK',
        ],
    ]) ?>

</div>
