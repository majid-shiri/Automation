<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SignatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Signatures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signature-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Signature', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sig_id',
            'sig_us_id',
            'sig_let_id',
            'sig_state',
            'sig_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Signature $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'sig_id' => $model->sig_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
