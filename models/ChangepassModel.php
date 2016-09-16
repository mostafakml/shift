<?php
namespace app\models;
use yii;
use yii\base\Model;





class ChangepassModel extends Model
{
    public $password;
    public $newpassword;
    public $password_repeat;

    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'newpassword','password_repeat'], 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'newpassword', 'message'=>"Passwords don't match" ],
            [['password'], 'validatePass'],
            // rememberMe must be a boolean value

            // password is validated by validatePassword()

        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'کلمه عبور',
            'newpassword'=>'کلمه عبور جدید',
            'password_repeat' => 'تایید کلمه ورود',
        ];
    }
    public function validatePass($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $Umodel=Account::findOne(Yii::$app->user->id);
            if (!$Umodel->validatePassword($this->password)) {
                $this->addError($attribute, 'کلمه عبور فعلی اشتباه میباشد.');
                return false;
            }
            return true;
        }
    }
}