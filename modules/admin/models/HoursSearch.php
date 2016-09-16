<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use hoomanMirghasemi\jdf\Jdf;
use app\models\Hours;
use app\models\Account;

/**
 * This is the model class for table "hours".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $type
 * @property integer $time
 *
 * @property Account $user
 */
class HoursSearch extends Hours
{
    public $fullname;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'login', 'logout','fullname'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Account::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Hours::find();

        // add conditions that should always apply here
        //$query->joinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            //'id' => $this->id,
             'user_id' => $this->user_id,
            // 'login' => $this->login,
            // 'logout' => $this->logout,
            'active'=>1
        ]);



        $query->orderBy('login DESC');

        if ($this->login) {
            $exploded = explode("/",$this->login);
    		$date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
    		$this->login = strtotime($date.' 00:00:00');
            $query->andWhere('login >= '.$this->login);
            $this->login = Jdf::jdate('Y/m/d',$this->login);
        }
        if ($this->logout) {
            $exploded = explode("/",$this->logout);
    		$date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
    		$this->logout = strtotime($date.' 23:59:59');
            $query->andWhere('login <= '.$this->logout);
            $this->logout = Jdf::jdate('Y/m/d',$this->logout);
        }

        return $dataProvider;
    }
}
