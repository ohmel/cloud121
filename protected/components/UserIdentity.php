<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
//    public $username;
//    public $userdet;
//    public $church_id;
    public $user_id;
//    public $user_fullname;
    
    public function authenticate() {

        $model = AppUsers::model()->find('user_name=:user_name and user_password=:user_password', array(':user_name'=>$this->username, ':user_password'=>md5($this->password)));
//        echo $model->user_name;exit;
//        $users = array(
//            // username => password
//            'demo' => 'demo',
//            'admin' => 'admin',
//        );
        if ($model->user_name !== $this->username)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($model->user_password !== md5($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
//            $this->username = $model->user_name;
//            $model->user_password = md5('sdf');
//            $this->userdet = $model->attributes;
//            $this->church_id = $model->church_id;
            $this->user_id = $model->user_id;
//            $this->user=$model->attributes;
//            $this->user_fullname = $model->user_fullname;
            $this->errorCode = self::ERROR_NONE;
        return !$this->errorCode;
    }
    public function getId(){
        return $this->user_id;
    }
}