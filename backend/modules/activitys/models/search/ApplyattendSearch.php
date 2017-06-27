<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\ApplyAttend;

/**
 * ApplyattendSearch represents the model behind the search form about `backend\modules\activitys\models\ApplyAttend`.
 */
class ApplyattendSearch extends ApplyAttend
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'aid','item','number', 'ispay', 'status'], 'integer'],
            [['uid', 'name', 'phone', 'remark','explain', 'created_time', 'updated_time'], 'safe'],
            [[ 'cost'], 'number'],
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
        $query = ApplyAttend::find()->orderBy('id desc');

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
            'sid' => $this->sid,
            'aid' => $this->aid,
            'ispay' => $this->ispay,
            'cost' => $this->cost,
            'number' => $this->number,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'explain', $this->explain])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
