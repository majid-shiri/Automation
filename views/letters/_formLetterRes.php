<?php

use app\controllers\LettersController;
use hoomanMirghasemi\jdf\Jdf;
use yii\helpers\Html;
use yii\helpers\Url; ?>
<div style="color: #000000">

    <figure class="tables" style="direction: ltr;">
        <table style="border-top: 0px;">
            <tbody>
            <tr>
                <td style="; height: 220px; padding: 0px; text-align: center; width: 500px;">
                    <p style="font-family: sabnams;font-size: 86%;padding-top: 30%;">&nbsp;&nbsp;&nbsp;شماره:&nbsp;&nbsp;<?=$model->let_NumberIn?>&nbsp;&nbsp; &nbsp;تاریخ :&nbsp;&nbsp;<?=$model->let_Date?>&nbsp;&nbsp;پیوست:&nbsp;&nbsp;<?= $model->let_AttachType ?></p>

                </td>
                <td style="height: 220px; padding: 0px; text-align: center; width: 500px;">
                    <?php
                    if($model->let_Type!=1){
                        echo Html::img(Url::to('@web/web/imgprofile/H-a4-R2.jpg'), ['class'=>'logoA4']);
                    }
                        ?>
                </td>
                <td style="height: 220px; padding: 0px; text-align: center; width: 500px;">
                    <?php
                    if($model->let_Type!=1){
                        echo Html::img(Url::to('@web/web/imgprofile/H-a4-R1.jpg'), ['style'=>'max-width:100%','class'=>'logoA4']);
                    }
                    ?>
                </td>
            </tr>
            </tbody>
        </table>
    </figure>



    <h3 style="text-align: center;">بسمه تعالی</h3>
    <p style="direction: rtl;font-family: bTitrs;font-weight: bold;"><?= $model->let_Recipient ?></p>
    <p style="direction: rtl;font-family: bTitrs;">موضوع:<?= $model->let_Subject ?></p>
    <p style="text-align: justify;padding: 0 50px 0 40px;"><?= $model->let_Text; ?></p>
    <p><br/><br/></p>
    <figure class="tables" style="direction: ltr;">
        <table style="border-top: 0px;">
            <tbody>
            <tr>
                <?php
                if ($model->let_Type==1){
                    echo '<td style="; height: 220px; padding: 0px; text-align: center; width: 500px;">'.$model->let_Sender.'</td>';
                }else{
                    if ($signature){
                        foreach ($signature as $item){
                            echo $item;
                        }
                    }
                }

                ?>
            </tr>
            </tbody>
        </table>
    </figure>
    <section dir="rtl">
        <p id="copiestype" style="text-align: right;margin-right: 50px"><?php
            if ($model->let_CopiesType) {
                echo 'رونوشت:&nbsp; &nbsp;&nbsp;';
            }
            ?></p>
        <p style="text-align: right;margin-right: 40px">
            <?php
            if (!empty($model->let_CopiesType)) {
                foreach ($cop as $val) {
                    echo $val->cop_Title . '<br>';
                }
            }
            ?>
        </p>
    </section>
    <p><strong>&nbsp;</strong></p>
    <section>
        <?php
        if($model->let_Type!=1){
            echo ' <img src="../../f-a4.png" style="z-index: -1;width: 100%;">';
        }
        ?>
    </section>
</div>

<style>
    .tables {
        width: 100%;
        margin-bottom: 1rem;
        border: 0px;
    }
    .stamp{
        position: absolute;
        margin-top: 100px;
        margin-left: -80px;
    }
    .singActor{
        position: absolute;
        margin-left: -80px;
        margin-top: 30px;
    }
    .logoA4{
        max-width: 85%;
    }
</style>