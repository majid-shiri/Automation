<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome;
use app\assets\AppAsset;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
<!--                            <div class="col-lg-6 "></div>-->
                            <div class="col-lg-12">
                                <div class="p-5">
                                  <div class="text-center">
                                      <h1 class="h4 text-gray-900 mb-4"><i class="icon-keivanjavidlogo-light" style="font-size: 87px;"></i></br>سیستم مانا</h1>
                                   </div>

                                        <?php $form = ActiveForm::begin([
                                            'id' => 'login-form',
                                        ]); ?> <?= $form->field($model, 'username',['inputOptions' => ['class' => 'form-control form-control-user']])->textInput(['autofocus' => true]) ?>

                                        <?= $form->field($model, 'password',['inputOptions' => ['class' => 'form-control form-control-user']])->passwordInput()  ?>


                                        <div class="form-group">
                                                <?= Html::submitButton('ورود', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>
<!--                                    <hr>-->
<!--                                    <div class="text-center">-->
<!--                                        <a class="small" href="forgot-password.html">فراموشی رمز عبور</a>-->
<!--                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-auto">
                        <div class="copyright text-Left my-auto">
                            <i class="icon-keivanjavidlogo"></i> <span>سیستم مانا -نسخه بتا 1.0.0</span>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>


</div>
