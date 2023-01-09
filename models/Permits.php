<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permits".
 *
 * @property int $permit_id
 * @property int|null $permit_us_id
 * @property int|null $permit_10
 * @property int|null $permit_11
 * @property int|null $permit_12
 * @property int|null $permit_13
 * @property int|null $permit_14
 * @property int|null $permit_15
 * @property int|null $permit_16
 * @property int|null $permit_20
 * @property int|null $permit_21
 * @property int|null $permit_22
 * @property int|null $permit_23
 * @property int|null $permit_24
 * @property int|null $permit_25
 * @property int|null $permit_30
 * @property int|null $permit_31
 * @property int|null $permit_32
 * @property int|null $permit_33
 * @property int|null $permit_40
 * @property int|null $permit_41
 * @property int|null $permit_42
 * @property int|null $permit_43
 * @property int|null $permit_44
 */
class Permits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'permits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['permit_us_id', 'permit_10', 'permit_11', 'permit_12', 'permit_13', 'permit_14', 'permit_15', 'permit_16', 'permit_20', 'permit_21', 'permit_22', 'permit_23', 'permit_24', 'permit_25', 'permit_30', 'permit_31', 'permit_32', 'permit_33', 'permit_40', 'permit_41', 'permit_42', 'permit_43', 'permit_44'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'permit_id' => 'Permit ID',
            'permit_us_id' => 'Permit Us ID',
            'permit_10' => 'Permit 10',
            'permit_11' => 'Permit 11',
            'permit_12' => 'Permit 12',
            'permit_13' => 'Permit 13',
            'permit_14' => 'Permit 14',
            'permit_15' => 'Permit 15',
            'permit_16' => 'Permit 16',
            'permit_20' => 'Permit 20',
            'permit_21' => 'Permit 21',
            'permit_22' => 'Permit 22',
            'permit_23' => 'Permit 23',
            'permit_24' => 'Permit 24',
            'permit_25' => 'Permit 25',
            'permit_30' => 'Permit 30',
            'permit_31' => 'Permit 31',
            'permit_32' => 'Permit 32',
            'permit_33' => 'Permit 33',
            'permit_40' => 'Permit 40',
            'permit_41' => 'Permit 41',
            'permit_42' => 'Permit 42',
            'permit_43' => 'Permit 43',
            'permit_44' => 'Permit 44',
        ];
    }
}
