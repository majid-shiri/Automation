<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%References}}`.
 */
class m211021_062433_create_Referencs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Referencs}}', [
            'ref_Id' => $this->primaryKey(),
            //آیدی کاربر جهت ارجاع
            'ref_us_FK'=>$this->integer(),
            //آیدی کاربر ارجاع دهنده
            'ref_sender_FK'=>$this->integer(),
            //آیدی نامه
            'ref_let_FK'=>$this->integer(),
            //وضعیت خواندن
            'ref_readstate'=>$this->integer(),
            //تاریخ ارجاع
            'ref_date'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Referencs}}');
    }
}
