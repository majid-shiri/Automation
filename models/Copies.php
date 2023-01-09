<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "copies".
 *
 * @property int $cop_Id
 * @property string|null $cop_Title
 * @property int|null $cop_let_FK
 */
class Copies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'copies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cop_let_FK'], 'integer'],
            [['cop_Title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cop_Id' => 'Cop  ID',
            'cop_Title' => 'Cop  Title',
            'cop_let_FK' => 'Cop Let  Fk',
        ];
    }
}
