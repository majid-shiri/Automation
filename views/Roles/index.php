<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RolseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Roles', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'rol_id',
            'rol_name',
            ['attribute' => 'rol_description',
                'filter'=>false,
                'mergeHeader'=>true,
                'value' => function ($data) {
                    if ($data->rol_description != null) {
                        return  $data->rol_description;
                    } else {
                        return '-----';
                    }
                }],

            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{update} {delete}',
                'header' => 'عملیات',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fad fa-trash-alt"></i>', ['delete', 'rol_id' => $model->rol_id], [
                            'class' => 'delete',
                            'data' => [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                                'pjax' => 0,
                                'title' => Yii::t('yii', 'Confirm?'),
                                'ok' => Yii::t('yii', 'Confirm'),
                                'cancel' => Yii::t('yii', 'Cancel'),
                            ],
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fad fa-edit"></i>', ['update', 'rol_id' => $model->rol_id], [
                        ]);
                    }
                ]
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
