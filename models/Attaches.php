<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attaches".
 *
 * @property int $at_Id
 * @property string|null $at_FileName
 * @property string|null $at_Url
 * @property int|null $at_Letters_FK
 * @property int|null $at_Us_FK
 */
class Attaches extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attaches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['at_Letters_FK', 'at_Us_FK'], 'integer'],
            [['at_FileName', 'at_Url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'at_Id' => 'At  ID',
            'at_FileName' => 'At  File Name',
            'at_Url' => 'At  Url',
            'at_Letters_FK' => 'At  Letters  Fk',
            'at_Us_FK' => 'At  Us  Fk',
        ];
    }
}
