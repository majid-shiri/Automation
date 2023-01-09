<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "users".
 *
 * @property int $us_id
 * @property string $us_username
 * @property string $us_password
 * @property string $us_fname
 * @property string $us_lname
 * @property int $us_apsnelcode
 * @property int $us_gender
 * @property int $us_online
 * @property int $us_status
 * @property string $us_nickname
 * @property int|null $us_mobile
 * @property int|null $us_phone
 * @property string $us_email
 * @property int $us_role
 * @property string|null $us_pic
 * @property string|null $us_sign
 * @property int $us_created_at
 * @property int $us_updated_at
 * @property int|null $imagesign
 * @property int|null $pathimage
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function RolesArray(){
        $Roles=Roles::find()->all();
        $RolosArrays=ArrayHelper::map($Roles,'rol_id','rol_name');
        return $RolosArrays;
    }
    public $imagesign;
    public $pathimage;
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['us_username', 'us_password', 'us_fname', 'us_lname', 'us_apsnelcode', 'us_gender', 'us_nickname', 'us_email', 'us_role'], 'required'],
            [['us_apsnelcode', 'us_gender', 'us_online', 'us_status', 'us_mobile', 'us_phone', 'us_role'], 'integer'],
            [['us_username', 'us_password', 'us_email', 'us_pic','us_sign','pathimage'], 'string', 'max' => 255],
            [['us_fname', 'us_lname'], 'string', 'max' => 200],
            [['us_nickname'], 'string', 'max' => 25],
            [['us_username'], 'unique'],[['us_username'], 'trim'],
            [['us_apsnelcode'], 'unique'],
            [['us_email'], 'unique'],
            [['us_email'], 'email'],
            [['imagesign'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'us_id' => 'Us ID',
            'us_username' => 'نام کاربری',
            'us_password' => 'رمز عبور',
            'us_fname' => 'نام',
            'us_lname' => 'نام خانوادگی',
            'us_apsnelcode' => 'کد پرسنلی',
            'us_gender' => 'جنسیت',
            'us_online' => 'Us Online',
            'us_status' => 'وضعیت',
            'us_nickname' => 'آیدی',
            'us_mobile' => 'موبایل',
            'us_phone' => 'تلفن',
            'us_email' => 'ایمیل',
            'us_role' => 'مسئولیت',
            'us_pic' => 'تصویر کاربر',
            'us_sign'=>'امضا کاربر',
            'imagesign'=>'امضا کاربر',
            'pathimage'=>'مسیر پروفایل',
            'us_created_at' => 'تاریخ ایجاد',
            'us_updated_at' => 'تاریخ بروزرسانی',
        ];
    }
    public function upload()
    {
        $path = 'uploads/sign/';
        if ($this->validate()) {
            if ($mod2->save()) {
                $this->imagesign->saveAs('uploads/sign/' .time(). $this->imagesign->baseName . '.' . $this->imagesign->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}
