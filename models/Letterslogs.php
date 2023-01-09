<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "letterslogs".
 *
 * @property int $let_log_Id
 * @property int|null $let_log_Category
 * @property int|null $let_log_us_FK
 * @property int|null $let_log_let_FK
 * @property int|null $let_log_num_sys
 * @property int|null $let_log_Date
 */
class Letterslogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $category=[
        'trashDraft'=>'0',
        'Draft'=>'1',
        'Referral'=>'2',
        'Seen'=>'3',
        'Replay'=>'4',
        'Paraff'=>'5',
        'Archive'=>'6',
        'MoveTrash'=>'7',
        'Edit'=>'8',
        'Attach'=>'9',
        'Accept'=>'10',
        'NotAccept'=>'11',
    ];
    public static function tableName()
    {
        return 'letterslogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['let_log_Category', 'let_log_us_FK', 'let_log_let_FK', 'let_log_Date'], 'integer'],
            [['let_log_num_sys'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'let_log_Id' => 'Let Log  ID',
            'let_log_Category' => 'Let Log  Category',
            'let_log_us_FK' => 'Let Log Us  Fk',
            'let_log_let_FK' => 'Let Log Let  Fk',
            'let_log_num_sys' => 'Let Log num  sys',
            'let_log_Date' => 'Let Log  Date',
        ];
    }
}
