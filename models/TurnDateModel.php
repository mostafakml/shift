<?php
namespace app\models;
use yii;
use yii\base\Model;
use hoomanMirghasemi\jdf\Jdf;
class TurnDateModel extends Model
{
    const SCENARIO_OVERTIME='overtime';
    const SCENARIO_EXITREQ='exitreq';
    public $date;
    public $startTime;
    public $endTime;
    public function rules()
    {
        return [
            // username and password are both required
            [['date', 'startTime','endTime'], 'required'],
            
            

        ];
        
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_OVERTIME] =['date','startTime','endTime'];
        $scenarios[self::SCENARIO_EXITREQ] =['date','startTime','endTime'];


        return $scenarios;
    }
    public function attributeLabels()
    {
        return [
            'date' => 'تاریخ',
            'startTime'=>'ساعت شروع',
            'endTime' => 'ساعت پایان',
        ];
    }
    public function setTimestamp($id){
        $exploded = explode("-",$this->date);


        $date = Jdf::jalali_to_gregorian($exploded[2],$exploded[1],$exploded[0],'-');
        $login = strval(strtotime($date.' '.$this->startTime));
        $logout=strval(strtotime($date.' '.$this->endTime));
        $model=new  Hours();


        
        if ($logout>$login){
            $model->exit_type='ADMIN';

            if ($this->scenario=='overtime'){

                $model->type='OVERTIME';
                $model->exit_type='SELF';

            }if($this->scenario=='exitreq'){
                $model->type='EXIT';
                $model->exit_type='SELF';
               
            }


            $model->login=$login;
            $model->logout=$logout;
            $model->user_id=$id;
            $model->verified=1;
            $model->active=1;
            return  $model->save();
            }
        


    }
}