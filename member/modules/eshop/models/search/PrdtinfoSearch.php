<?php

namespace member\modules\eshop\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\eshop\models\Prdtinfo;

/**
 * PrdtinfoSearch represents the model behind the search form about `member\modules\eshop\models\Prdtinfo`.
 */
class PrdtinfoSearch extends Prdtinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'limit1', 'limit2', 'limit3', 'status'], 'integer'],
            [['price1', 'price2', 'price3'], 'number'],
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
        $query = Prdtinfo::find()->orderBy('id desc');

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
            'limit1' => $this->limit1,
            'price1' => $this->price1,
            'limit2' => $this->limit2,
            'price2' => $this->price2,
            'limit3' => $this->limit3,
            'price3' => $this->price3,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
