<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\RelayActivity;

/**
 * RelayactivitySearch represents the model behind the search form about `backend\modules\activitys\models\RelayActivity`.
 */
class RelayactivitySearch extends RelayActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'willnum', 'visit', 'status'], 'integer'],
            [['title', 'imgurl', 'start_time', 'end_time', 'merchant', 'send_title', 'send_detail', 'content', 'u_id', 'created_time', 'updated_time'], 'safe'],
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
        $query = RelayActivity::find()->orderBy('id desc');

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
            'type' => $this->type,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'willnum' => $this->willnum,
            'visit' => $this->visit,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'imgurl', $this->imgurl])
            ->andFilterWhere(['like', 'merchant', $this->merchant])
            ->andFilterWhere(['like', 'send_title', $this->send_title])
            ->andFilterWhere(['like', 'send_detail', $this->send_detail])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'u_id', $this->u_id]);

        return $dataProvider;
    }
}
