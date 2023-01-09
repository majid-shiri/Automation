<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%permits}}`.
 */
class m220113_061549_create_permits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%permits}}', [
            'permit_id' => $this->primaryKey(),
            'permit_us_id'=>$this->integer(),
            //permit 1 (10) پیش نویس ها
            'permit_10'=>$this->smallInteger(),
            //permit 1-1 (11) ایجاد
            'permit_11'=>$this->smallInteger(),
            //permit 1-2 (12) مشاهده
            'permit_12'=>$this->smallInteger(),
            //permit 1-3 (13) ارجاع
            'permit_13'=>$this->smallInteger(),
            //permit 1-4 (14) ارجاع جهت تایید
            'permit_14'=>$this->smallInteger(),
            //permit 1-5 (15) بروزرسانی
            'permit_15'=>$this->smallInteger(),
            //permit 1-6 (16) حذف
            'permit_16'=>$this->smallInteger(),
            //permit 2 (20)دریافتی ها
            'permit_20'=>$this->smallInteger(),
            //permit 2-1 (21) مشاهده
            'permit_21'=>$this->smallInteger(),
            //permit 2-2 (22) امضا
            'permit_22'=>$this->smallInteger(),
            //permit 2-3 (23) ارجاع
            'permit_23'=>$this->smallInteger(),
            //permit 2-4 (24) پاسخ
            'permit_24'=>$this->smallInteger(),
            //permit 2-5 (25) پاراف
            'permit_25'=>$this->smallInteger(),
            //permit 3 (30) دریافتی ها جهت تایید
            'permit_30'=>$this->smallInteger(),
            //permit 3-1 (31) مشاهده
            'permit_31'=>$this->smallInteger(),
            //permit 3-2 (32) تایید / رد
            'permit_32'=>$this->smallInteger(),
            //permit 3-3 (33) ارجاع
            'permit_33'=>$this->smallInteger(),
            //permit 4 (40) کاربران
            'permit_40'=>$this->smallInteger(),
            //permit 4-1 (41) ایجاد
            'permit_41'=>$this->smallInteger(),
            //permit 4-2 (42) تنظیم مجوز
            'permit_42'=>$this->smallInteger(),
            //permit 4-3 (43) بروزرسانی
            'permit_43'=>$this->smallInteger(),
            //permit 4-4 (44) حذف
            'permit_44'=>$this->smallInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%permits}}');
    }
}
