<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "roles".
 *
 * @property int $rol_id
 * @property string $rol_name
 * @property string|null $rol_description
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol_name'], 'required'],
            [['rol_name'], 'string', 'max' => 200],
            [['rol_description'], 'string', 'max' => 255],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rol_id' => 'آیدی',
            'rol_name' => 'مسئولیت',
            'rol_description' => 'شرح',
        ];
    }
}
