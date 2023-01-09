<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "signature".
 *
 * @property int $sig_id
 * @property int|null $sig_us_id
 * @property int|null $sig_let_id
 * @property int|null $sig_state
 * @property int|null $sig_date
 */
class Signature extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'signature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sig_us_id', 'sig_let_id', 'sig_state', 'sig_date'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sig_id' => 'Sig ID',
            'sig_us_id' => 'Sig Us ID',
            'sig_let_id' => 'Sig Let ID',
            'sig_state' => 'Sig State',
            'sig_date' => 'Sig Date',
        ];
    }
}
