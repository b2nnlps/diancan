<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\modules\merchant\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'province', 'city', 'district', 'payment_method', 'payment_status', 'receiv_status', 'shipment_status', 'shipment_id', 'clearing', 'status'], 'integer'],
            [['rh_openid', 'sn', 'referrer', 'consignee', 'phone', 'address', 'receive_time', 'remark', 'zipcode','operator', 'created_time', 'updated_time'], 'safe'],
            [['amount'], 'number'],
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
        $query = Order::find();

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
            'amount' => $this->amount,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'receive_time' => $this->receive_time,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'receiv_status' => $this->receiv_status,
            'shipment_status' => $this->shipment_status,
            'shipment_id' => $this->shipment_id,
            'clearing' => $this->clearing,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'referrer', $this->referrer])
            ->andFilterWhere(['like', 'consignee', $this->consignee])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'operator', $this->operator]);

        return $dataProvider;
    }
}
