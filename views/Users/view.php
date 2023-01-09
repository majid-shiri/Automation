<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use hoomanMirghasemi\jdf\Jdf;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title).':'.$model->us_fname .'  '.$model->us_lname?></h1>

    <p>
        <?= Html::a('بروزرسانی', ['update', 'us_id' => $model->us_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('بازگشت', ['index'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('حذف', ['delete', 'us_id' => $model->us_id], [
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
            'us_username',
            ['attribute' => 'us_password',
                'value' => function ($data) {
                    return base64_decode($data->us_password);
                }],
            'us_fname',
            'us_lname',
            'us_apsnelcode',
            ['attribute' => 'us_gender',
                'value' => function ($model) {
                    if($model->us_gender == 1)
                        {return 'مرد';}
                    else
                        {return 'زن';}
                }],
            ['attribute' => 'us_online',
                'value' => function ($model) {
                    if($model->us_online == 1)
                        {return 'آنلاین';}
                    else
                        {return 'آفلاین';}
                }],
            ['attribute' => 'us_status',
                'value' => function ($model) {
                    if($model->us_status == 1)
                    {return 'فعال';}
                    else
                    {return 'غیرفعال';}
                }],
            'us_nickname',
            'us_mobile',
            'us_phone',
            'us_email:email',
            'us_role',
            'us_pic',
            ['attribute' => 'us_created_at',
                'format'=>'raw',
                'value' => function ($data) {
                    return Jdf::jdate('H:i:s Y-m-d  ', $data->us_created_at);
                }],
            ['attribute' => 'us_updated_at',
                'format'=>'raw',
                'value' => function ($data) {
                    if ($data->us_updated_at != 0) {
                        return Jdf::jdate('H:i:s Y-m-d ', $data->us_updated_at);
                    } else {return '-----';}
                }]
        ],
    ]) ?>

</div>
