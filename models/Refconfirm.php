<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "refconfirm".
 *
 * @property int $refconf_id
 * @property int|null $refconf_sender_FK
 * @property int|null $refconf_let_FK
 * @property int|null $refconf_readstate
 * @property int|null $refconf_us_FK
 * @property int|null $refconf_date
 */
class Refconfirm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'refconfirm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['refconf_sender_FK', 'refconf_let_FK', 'refconf_readstate', 'refconf_us_FK', 'refconf_date'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'refconf_id' => 'Refconf ID',
            'refconf_sender_FK' => 'Refconf Sender  Fk',
            'refconf_let_FK' => 'Refconf Let  Fk',
            'refconf_readstate' => 'Refconf Readstate',
            'refconf_us_FK' => 'Refconf Us  Fk',
            'refconf_date' => 'Refconf Date',
        ];
    }
}
