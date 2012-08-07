<?php
class MyWebUser extends CWebUser
{
//    public function __get($name)
//    {
//        if ($this->hasState('__userInfo')) {
//            $user=$this->getState('__userInfo',array());
//            if (isset($user[$name])) {
//                return $user[$name];
//            }
//        }
// 
//        return parent::__get($name);
//    }
// 
//    public function login($identity, $duration) {
//        $this->setState('__userInfo', $identity->getUser());
//        parent::login($identity, $duration);
//    }
    
    public function getUser($attrib="")
    {   
//        echo $attrib;exit;
        $model = AppUsers::model()->findByPk(Yii::app()->user->getId());
        switch($attrib){
            case 'churchId':
                return $model->church_id;
                break;
            case 'fullname':
                return $model->user_fullname;
                break;
            case 'userId':
                return $model->user_id;
                break;
            case 'churchName':
                $church = Church::model()->findByPk($model->church_id);
                return $church->church_name;
                break;
            case 'churchCountry':
                $church = Church::model()->findByPk($model->church_id);
                return $church->address->country;
                break;
            default:
                return $model->attributes;
                break;
        }
    }
}
?>