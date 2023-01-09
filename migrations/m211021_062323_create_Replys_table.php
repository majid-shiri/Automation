<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Replys}}`.
 */
class m211021_062323_create_Replys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Replys}}', [
            'rep_Id' => $this->primaryKey(),
            //آیدی کاربر پاسخ دهنده
            'rep_us_FK'=>$this->integer(),
            //آیدی نامه پاسخ
            'rep_let_rep'=>$this->integer(),
            //آیدی نامه جهت پاسخ
            'rep_let_FK'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Replys}}');
    }
}
