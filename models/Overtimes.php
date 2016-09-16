<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "overtimes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $hour_id
 * @property string $record_time
 * @property string $location_Serve
 * @property string $description
 * @property integer $confirmed
 */
class Overtimes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'overtimes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hour_id', 'record_time', 'location_Serve', 'description', 'confirmed'], 'required'],
            [['user_id', 'hour_id', 'confirmed'], 'integer'],
            [['record_time'], 'safe'],
            [['description'], 'string'],
            [['location_Serve'], 'string', 'max' => 255],
        ];
    }
    public function getAccount()
    {
        return $this->hasOne(Account::className(), ['id' => 'user_id']);
    }
    public function getHours()
    {
        return $this->hasOne(Hours::className(), ['id' => 'hour_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'hour_id' => 'Hour ID',
            'record_time' => 'زمان ثبت درخواست',
            'location_Serve' => 'محل خدمت',
            'description' => 'توضیحات',
            'confirmed' => 'Confirmed',
        ];
    }

    /**
     * @inheritdoc
     * @return OvertimesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OvertimesQuery(get_called_class());
    }


    public function setNewrecord($id){
        $this->confirmed=0;
        $this->record_time=time();
        $this->hour_id=Hours::find()->max('id');
        $this->user_id=$id;
        $this->save();
        return $this->save();



        //$th
    }
    public function count(){
        $data=0;
        $data=Overtimes::find()->where('confirmed'==0)->count('id');
        return $data;
    }
    public function getVerfiy(){
        $data=null;
            if($this->confirmed==1){
                $data='تایید شده';

            }else{
                $data='تایید نشده';
            }
        return $data;
    }
    public function getLocation(){
        $data=null;
        if($this->location_Serve==1){
            $data='خارج شرکت';

        }else{
            $data='داخل شرکت';

        }
        return $data;
    }
}
