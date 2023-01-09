<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Paraffs}}`.
 */
class m211021_062343_create_Paraffs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Paraffs}}', [
            'parf_Id' => $this->primaryKey(),
            //متن پاراف
            'parf_Text'=>$this->text(),
            //آیدی کاربر
            'parf_us_FK'=>$this->integer(),
            //آیدی نامه
            'parf_let_FK'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Paraffs}}');
    }
}
