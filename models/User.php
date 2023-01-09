<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
class User extends ActiveRecord implements \yii\web\IdentityInterface
{


    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username,$password)
    {
        $FindUsers=static::findOne(['us_username'=>$username,'us_password'=>md5($password),'us_status'=>1]);
        if($FindUsers){
            $accesspermits=Permits::findOne(['permit_us_id'=>$FindUsers->us_id]);
            $session = Yii::$app->session;
            $session->set('us_id',$FindUsers->us_id);
            $session->set('us_fname',$FindUsers->us_fname);
            $session->set('us_lname',$FindUsers->us_lname);
            $session->set('us_pic',$FindUsers->us_pic);
            if($accesspermits){
                $session->set('permit_10',$accesspermits->permit_10);
                $session->set('permit_11',$accesspermits->permit_11);
                $session->set('permit_12',$accesspermits->permit_12);
                $session->set('permit_13',$accesspermits->permit_13);
                $session->set('permit_14',$accesspermits->permit_14);
                $session->set('permit_15',$accesspermits->permit_15);
                $session->set('permit_16',$accesspermits->permit_16);
                $session->set('permit_20',$accesspermits->permit_20);
                $session->set('permit_21',$accesspermits->permit_21);
                $session->set('permit_22',$accesspermits->permit_22);
                $session->set('permit_23',$accesspermits->permit_23);
                $session->set('permit_24',$accesspermits->permit_24);
                $session->set('permit_25',$accesspermits->permit_25);
                $session->set('permit_30',$accesspermits->permit_30);
                $session->set('permit_31',$accesspermits->permit_31);
                $session->set('permit_32',$accesspermits->permit_32);
                $session->set('permit_33',$accesspermits->permit_33);
                $session->set('permit_40',$accesspermits->permit_40);
                $session->set('permit_41',$accesspermits->permit_41);
                $session->set('permit_42',$accesspermits->permit_42);
                $session->set('permit_43',$accesspermits->permit_43);
                $session->set('permit_44',$accesspermits->permit_44);
            }
            return $FindUsers;
        }else{
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->us_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
//        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        $FindUsers=self::findOne(['us_password'=>md5($password)]);
        if($FindUsers){
            return true;
        }else{
            return null;
        }
    }

}
