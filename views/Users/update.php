<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->us_id, 'url' => ['view', 'us_id' => $model->us_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update">

    <h1><?= 'بروزرسانی کاربر: ' . $model->us_fname.' '.$model->us_lname; ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
