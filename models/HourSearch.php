<?php

namespace app\models;

use hoomanMirghasemi\jdf\Jdf;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Hours;


/**
 * HourSearch represents the model behind the search form about `app\models\Hours`.
 */
class HourSearch extends Hours
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id',  'verified', 'active'], 'integer'],
            [['login', 'logout'], 'string'],
            [['exit_type', 'type'], 'safe'],
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
            'id' => $this->id,
            'user_id' => Yii::$app->user->identity->getId(),
            'login' => $this->changeToTs($this->login),
            'logout' => $this->logout,
            'verified' => $this->verified,
            'active' => $this->active,
        ]);


        $query->andFilterWhere(['like', 'exit_type', $this->exit_type])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
    public function changeToTs($JdfType){
        switch ($JdfType) {
            case '':
                

        }
        if (!$JdfType==''){
            $dateTime = explode(" ",$JdfType);
            $exploded = explode("/",$dateTime[0]);
            $date = Jdf::jalali_to_gregorian($exploded[0],$exploded[1],$exploded[2],'-');
            return $timeStampType = strval(strtotime($date.' '.$dateTime[1]));

        }

    }
}
