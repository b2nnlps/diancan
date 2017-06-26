<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\RelayAwards;

/**
 * RelayawardsSearch represents the model behind the search form about `backend\modules\activitys\models\RelayAwards`.
 */
class RelayawardsSearch extends RelayAwards
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'prize_id',  'point','status'], 'integer'],
            [['isn', 'prize_name', 'sponsor_name', 'prize_winner', 'name', 'phone', 'win_time', 'get_time'], 'safe'],
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
        $query = RelayAwards::find();

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
            'prize_id' => $this->prize_id,
            'point' => $this->point,
            'status' => $this->status,
            'win_time' => $this->win_time,
            'get_time' => $this->get_time,
        ]);

        $query->andFilterWhere(['like', 'isn', $this->isn])
            ->andFilterWhere(['like', 'prize_name', $this->prize_name])
            ->andFilterWhere(['like', 'sponsor_name', $this->sponsor_name])
            ->andFilterWhere(['like', 'prize_winner', $this->prize_winner])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
