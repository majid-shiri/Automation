<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vw_recieveletter".
 *
 * @property int $let_Id
 * @property string $let_Subject
 * @property string|null $let_Abstract
 * @property string|null $let_Text
 * @property int|null $let_Date
 * @property string|null $let_Recipient
 * @property string|null $let_Sender
 * @property string|null $let_NumberIn
 * @property string|null $let_NumberSys
 * @property int|null $let_Type
 * @property int|null $let_ActionType
 * @property int|null $let_SecurityType
 * @property int|null $let_State
 * @property int|null $let_refconf
 * @property int|null $let_refconf_state
 * @property int|null $let_Referral
 * @property int|null $let_ReplayType
 * @property int|null $let_FollowUpType
 * @property int|null $let_AttachType
 * @property int|null $let_CopiesType
 * @property int|null $let_ParaffType
 * @property int|null $let_ArchiveType
 * @property int|null $let_ResDateType
 * @property int|null $let_ResDate
 * @property int|null $let_Create_at
 * @property int|null $let_Edit_at
 * @property int|null $let_us_FK
 * @property string $FullNameSender
 * @property string $FullNameReciever
 * @property int $ref_Id
 * @property int|null $ref_us_FK
 * @property int|null $ref_sender_FK
 * @property int|null $ref_readstate
 * @property int|null $ref_date
 */
class VwRecieveletter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vw_recieveletter';
    }
    public static function primaryKey()
    {
        return ['let_Id'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['let_Id', 'let_Date', 'let_Type', 'let_ActionType', 'let_SecurityType', 'let_State', 'let_Referral', 'let_ReplayType', 'let_FollowUpType', 'let_AttachType', 'let_CopiesType', 'let_ParaffType', 'let_ArchiveType', 'let_ResDateType', 'let_ResDate', 'let_Create_at', 'let_Edit_at', 'let_us_FK', 'ref_Id', 'ref_us_FK', 'ref_sender_FK', 'ref_readstate', 'ref_date'], 'integer'],
            [['let_Subject'], 'required'],
            [['let_Abstract', 'let_Text', 'let_Recipient', 'let_Sender'], 'string'],
            [['let_Subject'], 'string', 'max' => 400],
            [['let_NumberIn', 'let_NumberSys'], 'string', 'max' => 40],
            [['FullNameSender', 'FullNameReciever'], 'string', 'max' => 401],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'let_Id' => 'Let  ID',
            'let_Subject' => 'موضوع',
            'let_Abstract' => 'Let  Abstract',
            'let_Text' => 'Let  Text',
            'let_Date' => 'تاریخ نامه',
            'let_Recipient' => 'به',
            'let_Sender' => 'از',
            'let_NumberIn' => 'شماره نامه',
            'let_NumberSys' => 'اندیکاتور',
            'let_Type' => 'نوع نامه',
            'let_ActionType' => 'نوع اقدام',
            'let_SecurityType' => 'نوع حساسیت',
            'let_State' => 'Let  State',
            'let_refconf'=>'تاییدی',
            'let_refconf_state'=>'وضعیت تاییدی',
            'let_Referral' => 'Let  Referral',
            'let_ReplayType' => 'Let  Replay Type',
            'let_FollowUpType' => 'Let  Follow Up Type',
            'let_AttachType' => 'Let  Attach Type',
            'let_CopiesType' => 'Let  Copies Type',
            'let_ParaffType' => 'Let  Paraff Type',
            'let_ArchiveType' => 'Let  Archive Type',
            'let_ResDateType' => 'مهلت پاسخ',
            'let_ResDate' => 'تاریخ مهلت پاسخ',
            'let_Create_at' => 'Let  Create At',
            'let_Edit_at' => 'Let  Edit At',
            'let_us_FK' => 'Let Us  Fk',
            'FullNameSender' => 'ارجاع دهنده',
            'FullNameReciever' => 'گیرنده',
            'ref_Id' => 'Ref  ID',
            'ref_us_FK' => 'Ref Us  Fk',
            'ref_sender_FK' => 'Ref Sender  Fk',
            'ref_readstate' => 'وشعیت خوانده شدن',
            'ref_date' => 'تاریخ ارجاع',
        ];
    }
}
