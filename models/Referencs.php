<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "referencs".
 *
 * @property int $ref_Id
 * @property int|null $ref_us_FK
 * @property int|null $ref_sender_FK
 * @property int|null $ref_let_FK
 * @property int|null $ref_readstate
 * @property int|null $ref_date
 */
class Referencs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referencs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ref_us_FK', 'ref_let_FK'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ref_Id' => 'Ref  ID',
            'ref_us_FK' => 'گیرنده',
            'ref_sender_FK' => 'ارجاع دهنده',
            'ref_let_FK' => 'آیدی نامه',
            'ref_readstate'=> 'وضعیت',
            'ref_date'=>'تاریخ ارجاع'
        ];
    }
}
