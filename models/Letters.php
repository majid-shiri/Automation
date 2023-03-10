<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letters".
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
 * @property int|null $imageFiles
 * @property int|null $Copies
 * @property int|null $sigs
 */
class Letters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFiles;
    public $Copies;
    public $sigs;

    public static function tableName()
    {
        return 'letters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['let_Subject', 'let_Type', 'let_ActionType', 'let_SecurityType', 'let_Date'], 'required'],
            [['let_Text'], 'string'],
            [['let_Type', 'let_ActionType', 'let_SecurityType', 'let_State', 'let_Referral', 'let_ReplayType', 'let_FollowUpType', 'let_AttachType', 'let_CopiesType', 'let_ParaffType', 'let_ArchiveType', 'let_ResDateType', 'let_Create_at', 'let_us_FK'], 'integer'],
            [['let_Subject'], 'string', 'max' => 400],
            [['let_Abstract'], 'string', 'max' => 500],
            [['let_Recipient', 'let_Sender'], 'string', 'max' => 100],
            [['let_NumberIn', 'let_NumberSys'], 'string', 'max' => 40],
            [['let_ResDate','Copies','sigs'], 'default', 'value' => null],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'let_Id' => '???????? ????????',
            'let_Subject' => '??????????',
            'let_Abstract' => '??????????',
            'let_Text' => '?????? ????????',
            'let_Date' => '?????????? ???????? ',
            'let_Recipient' => '????????????',
            'let_Sender' => '??????????????',
            'let_NumberIn' => '?????????? ???????? ',
            'let_NumberSys' => '?????????? ???????? ????????????',
            'let_Type' => '?????? ????????',
            'let_ActionType' => '?????? ??????????',
            'let_SecurityType' => '?????? ????????????',
            'let_State' => '??????????',
            'let_refconf'=>'????????????',
            'let_refconf_state'=>'?????????? ????????????',
            'let_Referral' => '??????????',
            'let_ReplayType' => '???????? ???? ????????',
            'let_FollowUpType' => '????????????',
            'let_AttachType' => '??????????',
            'let_CopiesType' => '????????????',
            'let_ParaffType' => '??????????',
            'let_ArchiveType' => '??????????????',
            'let_ResDateType' => '???????? ????????',
            'let_ResDate' => '?????????? ???????? ????????',
            'let_Create_at' => '?????????? ??????????',
            'let_Edit_at' => '?????????? ????????????',
            'let_us_FK' => '?????????? ??????????',
            'imageFiles' => '???????? ?????? ??????????',
            'Copies' => '????????????',
            'sigs' => '??????????????????????',

        ];
    }

    public function upload($num, $usFK)
    {
        if ($this->validate()) {
            foreach ($this->imageFiles as $key=>$file) {
                $mod2 = new Attaches();
                $path = 'uploads/';
                $name = $file->baseName . '.' . $file->extension;
                $fn=time().$key. '.' . $file->extension;
                $mod2->at_FileName = $name;
                $mod2->at_Url = $path . $fn;
                $mod2->at_Letters_FK = $num;
                $mod2->at_Us_FK = $usFK;
                if ($mod2->save()) {
                    $file->saveAs($mod2->at_Url);
                }
            }
            return true;
        } else {
            return false;
        }
    }
    public function letlog($cat,$usFK,$letFK,$letNumSys){
        $letlog= new Letterslogs();
        $letlog->let_log_Category=$letlog->category[$cat];
        $letlog->let_log_us_FK=$usFK;
        $letlog->let_log_let_FK=$letFK;
        $letlog->let_log_num_sys=$letNumSys;
        $letlog->let_log_Date=strtotime(date('Y-m-d G:i:s'));
        $letlog->save();
    }
}
