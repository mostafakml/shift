<?php

namespace app\models;

use Yii;
use hoomanMirghasemi\jdf\Jdf;
use yii\filters\auth\CompositeAuth;

/**
 * This is the model class for table "hours".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $login
 * @property string $logout
 * @property string $exit_type
 *
 * @property Account $user
 * @property IpAddress $ipAddress
 */
class Hours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    const SCENARIO_OVERTIME='overtime';
    const SCENARIO_EXITREQ='exitreq';

    public static function tableName()
    {
        return 'hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exit_type','login','logout'], 'string'],
            [['verified'],'boolean'],
            //[['type'],'enum'],
            [['active'],'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_OVERTIME] =['exit_type','login','logout','type','verified','active','user_id'];
        $scenarios[self::SCENARIO_EXITREQ] =['exit_type','login','logout','type','verified','active','user_id'];


        return $scenarios;
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'login' => 'زمان شروع به کار',
            'logout' => 'زمان خاتمه کار',
            'exit_type' => 'Exit Type',
            'confirmed'=>'تایید',
            'type'=>'نوع',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Account::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function beforeSave($insert)
        ////////////////////////////
    {

//        switch ($this->scenario){
//            case 'update':
//                $this->changeFormatJdf();
//                $this->exit_type='ADMIN';
//            case 'adminlogin':
//                $this->login=time();
//                $this->active=1;
//            case 'adminlogout':
//                $this->logout=time();
//
//
//                $this->exit_type='ADMIN';
//
//            case 'userlogin':
//                $this->login=time();
//                $this->user_id = Yii::$app->user->id;
//                $this->active=1;
//
//            case 'userlogout':
//                $this->logout=time();
//
//
//                $this->exit_type='SELF';
//
//            default:
//
//        }






        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
    
    public function getExit_types(){
        $data=null;
        switch ($this->exit_type) {
            case 'SELF':
                $data= '<i class="fa fa-user fa-lg" aria-hidden="true"></i>';
                break;
            case 'ADMIN':
                $data=  $data= '<i class="fa fa-user-secret fa-lg" aria-hidden="true"></i>';
                break;
            case 'SYSTEM':
                $data= '<i class="fa fa-user-secret fa-lg" aria-hidden="true"></i>';
            case 'SYSTEM':
                $data='<i class="fa fa-server fa-lg" aria-hidden="true"></i>' ;
                break;
        }
        return $data;
    }
    public function validateAdmin(){

        $data=null;
        switch ($this->verified){
            case 1:
                $data='<i class="fa fa-check fa-lg" aria-hidden="true" ></i>';
            case 0;
                $data='<i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i>';



        }
        return $data;
    }
    
    public function setNewrecord($id){



        $dateTime = explode(" ",$this->login);
       

        $exploded = explode("/",$dateTime[0]);
       
        $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
        $login = strval(strtotime($date.' '.$dateTime[1]));

        $dateTime = explode(" ",$this->logout);
        $exploded = explode("/",$dateTime[0]);
        $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-') . ' ' . $dateTime[1];
        $logout = strval(strtotime($date));
        if ($logout>$login){
            $this->exit_type='ADMIN';
            if ($this->scenario=='overtime'){
                $this->type='OVERTIME';
                $this->exit_type='SELF';
            }if($this->scenario=='exitreq'){
                $this->type='EXIT';
                $this->exit_type='SELF';
            }


            $this->login=$login;
            $this->logout=$logout;
            $this->user_id=$id;
            $this->verified=1;
            $this->active=1;


            return  $this->save();
            
        }else{
            return false;
        }
       


//        return Hours::updateAll([
//            'login' => $login,
//            'logout' => $logout,
//            'user_id' => $id,
//            'exit_type' =>'ADMIN',
//        ],'id = :id',[':id' => $this->id]);
    }
    public function changeFormat(){
        $this->login=Jdf::jdate('YmdHis',$this->login);
        $this->logout=Jdf::jdate('YmdHis',$this->logout);
        

    }
    public function changeFormatJdf(){

        $dateTime = explode(" ",$this->login);
        $exploded = explode("/",$dateTime[0]);
        $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
        $this->login = strval(strtotime($date.' '.$dateTime[1]));

        $dateTime = explode(" ",$this->logout);
        $exploded = explode("/",$dateTime[0]);
        $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
        $this->logout = strval(strtotime($date.' '.$dateTime[1]));
        $this->verified=1;
        $this->exit_type='ADMIN';
         return $this->save();
    }
    public function getType(){
        $data='ساعت عادی';
        if ($this->type==1){
            $data='اضافه کاری';
        }
        return $data;
    }




}
