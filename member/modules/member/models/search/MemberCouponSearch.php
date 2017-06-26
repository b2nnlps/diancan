<?php

namespace member\modules\member\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\member\models\MemberCoupon;

/**
 * MemberCouponSearch represents the model behind the search form about `member\modules\member\models\MemberCoupon`.
 */
class MemberCouponSearch extends MemberCoupon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'quantity', 'cost', 'status', 'get_limit'], 'integer'],
            [['brand_name', 'title', 'sub_title', 'description', 'img', 'background', 'begin_time', 'end_time', 'created_time'], 'safe'],
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
        $query = MemberCoupon::find();

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
            'shop_id' => $this->shop_id,
            'quantity' => $this->quantity,
            'cost' => $this->cost,
            'status' => $this->status,
            'get_limit' => $this->get_limit,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'brand_name', $this->brand_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'background', $this->background]);

        return $dataProvider;
    }
}
