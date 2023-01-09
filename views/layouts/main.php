<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Html;
use rmrevin\yii\fontawesome;
use yii\helpers\Url;
use yii\widgets\Menu;
use hoomanMirghasemi\jdf\Jdf;

AppAsset::register($this);
$session = \Yii::$app->session;
$countnotification = Yii::$app->urlManager->createUrl(['site/counter-notification']);
$usids = $session->get('us_id');
$uspic=$session->get('us_pic');
$profileuser = Yii::$app->urlManager->createUrl(['users/profile']);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100" dir="rtl">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100" id="page-top">
<?php $this->beginBody() ?>
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           href="<?= yii::$app->urlManager->createUrl(['/']) ?>">
            <div class="sidebar-brand-text mx-3"> سیستم مانا</div>
            <div class="sidebar-brand-icon">
                <i class="icon-keivanjavidlogo"></i>
            </div>

        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= yii::$app->urlManager->createUrl(['/']) ?>">
                <i class="fal fa-th-large"></i>
                <span>داشبورد</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            کارتابل
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->urlManager->createUrl(['letters']) ?>">
                <i class="fad fa-file"></i>
                <span>پیش نویس ها</span>
                <span id="draftcount" class="notification"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->urlManager->createUrl(['recieveletter']) ?>">
                <i class="fad fa-inbox-in"></i>
                <span>دریافتی ها</span>
                <span id="referallcount" class="notification"></span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->urlManager->createUrl(['recieveletter']) ?>">
                <i class="far fa-spell-check"></i>
                <span>جهت تایید</span>
                <span id="refconfcount" class="notification"></span>
            </a>
        </li>
        <div class="sidebar-heading">
            تنظیمات
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="<?= yii::$app->urlManager->createUrl(['users']) ?>">
                <i class="fad fa-users"></i>
                <span>کاربران</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-gray-100 topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <?= Jdf::jdate('H:i:s Y-m-d '); ?>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav mr-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>
                    <!-- Nav Item - User Information -->
                    <li class="nav-link">

                    </li>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                                <span style="padding-left:10px "
                                      class="mr-2 d-lg-inline text-gray-600 small"><?= ' ' . $session->get('us_fname') . ' ' . $session->get('us_lname') . '  ' ?></span>
                            <?php
                            if($uspic){
                                echo Html::img(Url::to('@web/'.$uspic), ['class' => 'img-profile rounded-circle']);
                            }else{
                                echo Html::img(Url::to('@web/web/imgprofile/blank-profile.png'), ['class' => 'img-profile rounded-circle','id'=>'iconuser']);
                            }
                            ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-left shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <?= Html::a('<i class="fal fa-user-alt fa-fw mr-2 "></i>
                             پروفایل', FALSE, ['onclick'=>"
                             NProgress.start();
      $.post('$profileuser',{id:$usids},function(data) {
       $('#profile_modal').modal().show().find('#profile_modal_box').html(data);
        NProgress.done();
        });
                             return false;",'class' => 'dropdown-item']) ?>
                            <div class="dropdown-divider"></div>
                            <?= Html::a('<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 "></i>
                             خروج', ['site/logout'], ['data-method' => 'post', 'class' => 'dropdown-item']) ?>
                        </div>
                    </li>
                </ul>

            </nav>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= Alert::widget() ?>
                    <?= $content ?>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-Left my-auto">
                    <i class="icon-keivanjavidlogo"></i> <span>سیستم مانا -نسخه بتا 1.0.0</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php $this->endBody() ?>

<!--start profile Modal-->
<div class="modal fade" id="profile_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius: 30rem;">
            <div class="modal-body" style="padding: 0;">
                <div id="profile_modal_box">

                </div>
            </div>
        </div>
    </div>
</div>
<!--End profile Modal -->
<?php

$intScript = <<<JS
window.onload =countnotification();
function countnotification() {
    var id='$usids';
   $.ajax({
                url: '$countnotification',
                type: 'post',
                data: {id:id},
                dataType: 'JSON',
                success: function(response){
                    var draft = response.draft;
                    var referall = response.referall;
                    if(draft>0){
                        $('#draftcount').html(draft);
                        $('#draftcount').show();
                    }else{
                        $('#draftcount').hide();
                    }
                    if(referall>0){
                        $('#referallcount').html(referall);
                        $('#referallcount').show();
                    }else{
                        $('#referallcount').hide();
                    }
                    $('#refconfcount').hide();
                }
            });
}
JS;
$this->registerJs($intScript);
?>
</body>
</html>
<?php $this->endPage();
