<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ایجاد کاربر</h5>
    </div>
    <?php Pjax::begin(['id'=>'user-create','timeout'=>false]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php Pjax::end(); ?>

</div>
