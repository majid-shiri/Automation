<?php

use app\controllers\LettersController;
use hoomanMirghasemi\jdf\Jdf; ?>
<div style="color: black;">
    <section>
        <?php
        if($model->let_Type!=1){
            echo '<img src="../../H-a4.png" style="
    /* position: absolute; */
    z-index: 0;
    width: 100%;
">';
        }else{
            echo '<div style="
    /* position: absolute; */
    z-index: 0;
    width: 100%;
    height: 200px;
"></div>';
        }
        ?>

        <table style="height: 29px;z-index: 2;margin: -90px 756px 0 0;position: absolute;direction: ltr;" width="0">
            <tbody>
            <tr style="height: 29px;">
                <td style="height: 29px;padding: 25px;">
                    <p id="attache"><?= $model->let_AttachType ?></p>
                </td>
                <td style="height: 29px;padding: 15px;">
                    <p id="letdate"><?=$model->let_Date?></p>
                </td>
                <td style="height: 29px;padding: 25px;">
                    <p id="letnum"><?=$model->let_NumberIn?></p>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
    <section dir="rtl">
        <p>&nbsp;</p>
        <p><strong>&nbsp;</strong></p>
        <p style="text-align: center;font-size: 25px;"><strong>بسمه تعالی</strong></p>
        <p style="text-align: right; font-size: 20px;">&nbsp; &nbsp;&nbsp;<?= $model->let_Recipient ?></p>
        <p style="text-align: right;font-size: 20px;"> موضوع:&nbsp; &nbsp; &nbsp;<?=$model->let_Subject ?></p>
        <section style="text-align: right; margin-left: 10px;margin-right: 15px" ><?= $model->let_Text;?></section>
        <p>&nbsp;</p>
    </section>
    <section>
        <p id="sender" style="text-align: left;margin-left: 80px"><?=$model->let_Sender;?></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p>&nbsp;</p>
        <p id="copiestype" style="text-align: right;margin-right: 50px"><?php
            if($model->let_CopiesType){
                echo 'رونوشت:&nbsp; &nbsp;&nbsp;';
            }
            ?></p>
        <p style="text-align: right;margin-right: 40px">
            <?php
            if($model->let_CopiesType){
               foreach ($cop as $val){
                   echo $val->cop_Title.'<br>';
               }
            }
            ?>
        </p>
    </section>
    <p><strong>&nbsp;</strong></p>
    <section>
        <?php
        if($model->let_Type!=1){
            echo ' <img src="../../f-a4.png" style="
    /* position: absolute; */
    z-index: -1;
    width: 100%;
">';
        }
        ?>

    </section>
</div>
