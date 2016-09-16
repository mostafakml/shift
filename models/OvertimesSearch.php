<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Overtimes;

/**
 * OvertimesSearch represents the model behind the search form about `app\models\Overtimes`.
 */
class OvertimesSearch extends Overtimes
{
    /**
     * @inheritdoc
     */
    //public $hour;
    const SCENARIO_NEW='justNew';
    const SCENARIO_COMPLETE='completeList';

    public $account;
    public $hours;
    public function rules()
    {
        return [
            [['id', 'user_id', 'hour_id', 'record_time', 'confirmed',], 'integer'],
            [['location_Serve', 'description','account','hours'], 'safe'],

            ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_NEW] =['id', 'user_id', 'hour_id', 'record_time', 'confirmed',];
        $scenarios[self::SCENARIO_COMPLETE] =['id', 'user_id', 'hour_id', 'record_time', 'confirmed',] ;
        return $scenarios;
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
        $query = Overtimes::find();

        // add conditions that should always apply here
       // $query->joinWith([ 'account','hour']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        switch ($this->scenario){
            case 'justNew':
                $query->andFilterWhere([
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'hour_id' => $this->hour_id,
                    'record_time' => $this->record_time,
                    'confirmed' => 0,
                    ]);
                break;

            case 'completeList':
                $query->andFilterWhere([
                    'id' => $this->id,
                    'user_id' => $this->user_id,
                    'hour_id' => $this->hour_id,
                    'record_time' => $this->record_time,
                    'confirmed' => $this->confirmed,
                ]);
                break;

            return $query;

        }

        // grid filtering conditions

       // ->andFilterWhere(['like','account.fullname',$this->account]);

        $query->andFilterWhere(['like', 'location_Serve', $this->location_Serve])
            ->andFilterWhere(['like', 'description', $this->description]);
        return $dataProvider;
    }
}
