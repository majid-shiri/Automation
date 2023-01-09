<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Letters */

$this->title = Yii::$app->name;
$this->params['breadcrumbs'][] = ['label' => 'Letters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="letters-create">
    <?= $this->render('_form', [
        'model' => $model,
        'userpermit'=>$userpermit,
    ]) ?>

</div>
