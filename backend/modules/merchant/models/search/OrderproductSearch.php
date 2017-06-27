<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Orderproduct;

/**
 * OrderproductSearch represents the model behind the search form about `backend\modules\merchant\models\Orderproduct`.
 */
class OrderproductSearch extends Orderproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'order_id', 'product_id', 'number', 'status'], 'integer'],
            [['rh_openid', 'name', 'sku', 'remark', 'time'], 'safe'],
            [['price', 'amount'], 'number'],
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
        $query = Orderproduct::find();

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
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'number' => $this->number,
            'price' => $this->price,
            'amount' => $this->amount,
            'status' => $this->status,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
