<?php

namespace backend\modules\eshop\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\eshop\models\Kcsl;

/**
 * KcslSearch represents the model behind the search form about `backend\modules\eshop\models\Kcsl`.
 */
class KcslSearch extends Kcsl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'stock_id', 'access_stock', 'out_stock', 'types', 'number', 'status'], 'integer'],
            [['created_by', 'updated_by', 'created_time', 'updated_time'], 'safe'],
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
        $query = Kcsl::find()->orderBy('id desc');

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
            'stock_id' => $this->stock_id,
            'access_stock' => $this->access_stock,
            'out_stock' => $this->out_stock,
            'types' => $this->types,
            'number' => $this->number,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
