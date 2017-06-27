<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Orderstatus;

/**
 * OrderstatusSearch represents the model behind the search form about `backend\modules\merchant\models\Orderstatus`.
 */
class OrderstatusSearch extends Orderstatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_id', 'status'], 'integer'],
            [['rh_openid', 'remark', 'time'], 'safe'],
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
        $query = Orderstatus::find();

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
            'order_id' => $this->order_id,
            'status' => $this->status,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
