<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exit_request".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $hour_id
 * @property integer $record_time
 * @property string $description
 * @property integer $type
 * @property integer $confirmed
 */
class ExitRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exit_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hour_id', 'record_time', 'description', 'type', 'confirmed'], 'required'],
            [['user_id', 'hour_id', 'record_time', 'type', 'confirmed'], 'integer'],
            [['description'], 'string'],
        ];
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
            'description' => 'توضیحات',
            'type' => 'علت خروج',
            'confirmed' => 'Confirmed',
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

    public function setNewrecord($id)
    {
        $this->confirmed = 0;
        $this->record_time = time();
        $this->hour_id = Hours::find()->max('id');
        $this->user_id = $id;
        $this->save();
        return $this->save();
    }
}

