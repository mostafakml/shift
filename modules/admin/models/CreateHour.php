<?php
namespace app\modules\admin\models;

use yii\data\ActiveDataProvider;
use app\models\Hours;
use yii;
class CreateHour extends \yii\base\Model{
    public $login_time;
    public $logout_time;
    public $user_id;
    public function attributeLabels()
    {
        return [

            'login_time' => 'زمان ورود',
            'logout_time' => 'زمان خروج',
        ];
    }
   
    
    
    public function setNewrecord($id){
        var_dump($this->login_time);
        die();
        $exploded = explode("/",'');
        $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
        $this->login = strtotime($date.' 00:00:00');
        $model=new Hours();
        $model->save();
        return $model::updateAll([
            'login' => '',
            'logout' => '',
            'user_id' => $id,
            'exit_type' =>'ADMIN',
        ],'id = :id',[':id' => $model->id]);
    }

}
