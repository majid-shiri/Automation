<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%Copies}}`.
 */
class m211021_062401_create_Copies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%Copies}}', [
            'cop_Id' => $this->primaryKey(),
            //عنوان رونوشت
            'cop_Title'=>$this->string(),
            //آیدی نامه
            'cop_let_FK'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%Copies}}');
    }
}
