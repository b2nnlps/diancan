<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Agent;

/**
 * AgentSearch represents the model behind the search form about `backend\modules\merchant\models\Agent`.
 */
class AgentSearch extends Agent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'product_id', 'stock', 'bookable', 'sales', 'pv', 'status'], 'integer'],
            [['rh_openid', 'remark', 'operator', 'created_time', 'updated_time'], 'safe'],
            [['market_price', 'price'], 'number'],
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
        $query = Agent::find();

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
            'supplier_id' => $this->supplier_id,
            'product_id' => $this->product_id,
            'stock' => $this->stock,
            'bookable' => $this->bookable,
            'sales' => $this->sales,
            'pv' => $this->pv,
            'market_price' => $this->market_price,
            'price' => $this->price,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'operator', $this->operator]);

        return $dataProvider;
    }
}
