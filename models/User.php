<?php

namespace app\models;

use yii\db\ActiveRecord;
use Exception;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    /*
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    */

    public static function tableName() {
      return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
      $user = self::findOne($id);
      if(empty($user)) {
        return null;
      }
      return $user;
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null) {
      $user = self::findOne(['token' => $token]);
      if(empty($user)) {
        return null;
      }
      return $user;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
      $user = self::find()->where(['username' => $username])->one();
      if(empty($user)) {
        return null;
      }
      return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
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
        return $this->password === $this->ofuscatePassword($password);
    }

    public function ofuscatePassword($password) {
      if(empty(getenv('salt'))) {
        throw new Exception('no salt');
      }
      return md5(sprintf('%s-%s-%s', $password, $this->username, getenv('salt')));
    }

    public function beforeSave($insert) {
      if($insert == true) {
        $this->password = $this->ofuscatePassword($this->password);
      }
      return parent::beforeSave($insert);
    }
}
