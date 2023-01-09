<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Attaches}}`.
 */
class m211021_062021_create_Attaches_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Attaches}}', [
            'at_Id' => $this->primaryKey(),
            //نام فایل
            'at_FileName'=>$this->string(),
            //مسیر فایل
            'at_Url'=>$this->string(),
            //آیدی نامه
            'at_Letters_FK'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Attaches}}');
    }
}
