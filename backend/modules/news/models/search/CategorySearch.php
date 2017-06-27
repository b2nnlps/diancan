<?php

namespace backend\modules\news\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\news\models\NewsCategory;

/**
 * CategorySearch represents the model behind the search form about `backend\modules\news\models\NewsCategory`.
 */
class CategorySearch extends NewsCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'pid', 'status'], 'integer'],
            [['name', 'path', 'uid', 'created_time', 'updated_time'], 'safe'],
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
        $query = NewsCategory::find();

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
            'pid' => $this->pid,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'uid', $this->uid]);

        return $dataProvider;
    }
}
