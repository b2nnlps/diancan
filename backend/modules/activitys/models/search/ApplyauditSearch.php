<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\ApplyAudit;

/**
 * ApplyauditSearch represents the model behind the search form about `backend\modules\activitys\models\ApplyAudit`.
 */
class ApplyauditSearch extends ApplyAudit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'aid', 'status'], 'integer'],
            [['uid', 'item', 'name', 'phone', 'wx_number', 'remark', 'created_time', 'updated_time'], 'safe'],
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
        $query = ApplyAudit::find();

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
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'wx_number', $this->wx_number])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
