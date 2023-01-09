<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%letters}}`.
 */
class m211012_074737_create_letters_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%letters}}', [
            //آیدی نامه
            'let_Id' => $this->primaryKey(),
            //موضوع
            'let_Subject'=>$this->string(400)->notNull(),
            //چکیده
            'let_Abstract'=>$this->string(500),
            //متن نامه
            'let_Text'=>$this->text(),
            //تاریخ نامه
            'let_Date'=>$this->integer(11),
            //گیرنده
            'let_Recipient'=>$this->string(100),
            //فرستنده
            'let_Sender'=>$this->string(100),
            //شماره نامه وارده
            'let_NumberIn'=>$this->string(40),
            //شماره نامه سیستم
            'let_NumberSys'=>$this->string(40),
            //نوع نامه (وارده،صادره،داخلی ،خارجی)
            'let_Type'=>$this->smallInteger(),
            //نوع اقدام نامه (“عادی“، “فوری“، “خیلی فوری” و “آنی”)
            'let_ActionType'=>$this->smallInteger()->defaultValue(1),
            //نوع حساسیت و امنیت( “عادی“، “محرمانه“، “خیلی محرمانه“، “سری” و “به کلی سری” )
            'let_SecurityType'=>$this->smallInteger()->defaultValue(1),
            //نوع نامه (نامه یا پیش نویس)
            'let_State'=>$this->boolean(),
            //referall config
            'let_refconf'=>$this->boolean(),
            //referall config state
            'let_refconf_state'=>$this->smallInteger(),
            //ارجاعات
            'let_Referral'=>$this->boolean(),
            //پاسخ به نامه
            'let_ReplayType'=>$this->boolean(),
            //آیا پیگیری دارد یا خیر
            'let_FollowUpType'=>$this->boolean(),
            //آیا پیوست دارد یا خیر
            'let_AttachType'=>$this->boolean(),
            //رونوشت
            'let_CopiesType'=>$this->boolean(),
            //پاراف
            'let_ParaffType'=>$this->boolean(),
            //آیا بایگانی شده
            'let_ArchiveType'=>$this->boolean(),
            //مهلت پاسخ دارد یا خیر
            'let_ResDateType'=>$this->boolean(),
            //تاریخ مهلت پاسخ
            'let_ResDate'=>$this->integer(11),
            //تاریخ ایجاد نامه
            'let_Create_at'=>$this->integer(11),
            //تاریخ ویرایش
            'let_Edit_at'=>$this->integer(11),
            //کاربر ایجاد کننده
            'let_us_FK'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%letters}}');
    }
}
