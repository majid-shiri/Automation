<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$rand = rand(1, 3);
?>
    <style>
        .card-profile{
            height: 230px;
            background:#fff;
            border-radius: 1rem;
        }
        .cover{
            height: 150px;
            overflow: hidden;
            border-radius: 1rem;
        }
        .cover {
            background: -webkit-linear-gradient(132deg, #ffffff 28%, #d2d3d5 56%, #4e73df 100%);
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 80.8%);
        }
        .div-avatar{
            position: absolute;
            top: 25%;
            border-radius: 20%;
            left: 10%;
            width: 100px;
            height: 100px;
            overflow: hidden;
        }
        .div-avatar img
        {
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .div-avatar:hover .label-profile{
            display: block;
        }
        .label-profile{
            color: #fff;
            position: absolute;
            top: 0px;
            background-color: rgba(0,0,0,0.5);
            padding: 28px 21px;
            border-radius: 1rem;
            display: none;
            font-size: 15px;
            text-align: center;
            cursor: pointer;
          }
        .content-profile{
            font-family: "B Nazanin";
        }

        .name-user{
            position: absolute;
            left: 0;
            bottom: 0;
            margin: 0 0 40px 22px;
            color: black;
            font-size: x-large;
        }
        .role-user{
              position: absolute;
              bottom: 0;
              left: 0;
              margin: 0 0 25px 22px;
              font-family: 'Nazanin-b';
              font-size: 12px;
          }
        .id-user{
            direction: ltr;
            position: absolute;
            left: 0;
            bottom: 0;
            margin: 0 0 0px 22px;
            font-family: monospace;
            color: darkgray;
        }
        .imgsing{
            width: 150px;
            position: absolute;
            top: 75px;
            right: 10px;
        }
        .co{
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 1;
            padding: 5px 7px;
            border-radius: 25%;
        }
        .co:hover{
            background-color: rgba(0,0,0,0.07);
        }


    </style>
    <i class="fal fa-times cl_add_draft co" data-dismiss="modal"></i>
    <div class="card-profile">
        <div class="cover">

        </div>
        <div class="div-avatar">
            <?php
            if ($model->us_pic) {
                echo Html::img(Url::to('@web/' . $model->us_pic), ['class'=>'avatar','alt'=>'Profibild','id'=>'output']);
            } else {
                echo Html::img(Url::to('@web/web/imgprofile/blank-profile.png'), ['class'=>'avatar','alt'=>'Profibild','id'=>'output']);
            }
            ?>
            <label class="label-profile" for="profile"><i class="fad fa-camera-alt"></i><br>تغییر عکس</label>
            <input type="file" id="profile"  name="profile" accept=".png, .jpg, .jpeg" hidden onchange="loadFile(event)"/>
        </div>
        <div class="content-profile">
            <div class="name-user">
                <?=$model->us_fname.' '.$model->us_lname?>
            </div>
            <div class="role-user">
                <?='سمت : '.$Rolemodel->rol_name?>
            </div>

            <div class="id-user">
                <?='ID :@'.$model->us_nickname?>
            </div>
        </div>
        <div class="signature-user" >
            <?php
            if ($model->us_sign) {
                echo Html::img(Url::to('@web/'. $model->us_sign), ['class'=>'imgsing','alt'=>'Profibild','title'=>"", 'data-toggle'=>"tooltip",'data-original-title'=>"امضاء شما",'data-placement'=>"bottom"]);
            } else {
                echo "امضاء تعریف نشده";
            }
            ?>
        </div>
    </div>

<?php
$us_photo = Yii::$app->urlManager->createUrl(['users/saveimage']);
$change = <<<JS
$(function () { 
    $("[data-toggle='tooltip']").tooltip(); 
});
var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
 var formData = new FormData();
formData.append('file', $('#profile')[0].files[0]);
formData.append('id','$model->us_id');

$.ajax({
       url : '$us_photo',
       type : 'POST',
       data : formData,
       processData: false,  // tell jQuery not to process the data
       contentType: false,  // tell jQuery not to set contentType
       success : function(data) {
           document.getElementById("iconuser").src=data;
       }
});
}
JS;
$this->registerJs($change);
?>