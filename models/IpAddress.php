<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ip_address".
 *
 * @property integer $user_id
 * @property string $ip
 */
class IpAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ip_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ip'], 'required'],
            [['user_id'], 'integer'],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'ip' => 'Ip',
        ];
    }
}
