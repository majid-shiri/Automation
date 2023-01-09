<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%LettersLogs}}`.
 */
class m211021_062452_create_LettersLogs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%LettersLogs}}', [
            'let_log_Id' => $this->primaryKey(),
            //آیدی وقایع
            'let_log_Category'=>$this->integer(),
            //آیدی کاربر
            'let_log_us_FK'=>$this->integer(),
            //آیدی نامه
            'let_log_let_FK'=>$this->integer(),
            //شماره نامه
            'let_log_num_sys'=>$this->string(11),
            //زمان وقایع
            'let_log_Date'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%LettersLogs}}');
    }
}
