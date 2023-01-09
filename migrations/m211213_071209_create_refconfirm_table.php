<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%refconfirm}}`.
 */
class m211213_071209_create_refconfirm_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%refconfirm}}', [
            'refconf_id' => $this->primaryKey(),
            //آیدی کاربر ارجاع دهنده
            'refconf_sender_FK'=>$this->integer(),
            //آیدی نامه
            'refconf_let_FK'=>$this->integer(),
            //وضعیت خواندن
            'refconf_readstate'=>$this->integer(),
             //آیدی کاربر جهت تایید
            'refconf_us_FK'=>$this->integer(),
             //تاریخ ارجاع
            'refconf_date'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%refconfirm}}');
    }
}
