<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\ApplyActivity;

/**
 * ApplyactivitySearch represents the model behind the search form about `backend\modules\activitys\models\ApplyActivity`.
 */
class ApplyactivitySearch extends ApplyActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'supplier_id',  'restrict', 'willnum', 'pv', 'status'], 'integer'],
            [['title', 'imgurl', 'uid', 'charge', 'hedimg','url', 'intro', 'start_time', 'end_time', 'address', 'mapmove', 'merchant', 'initiator', 'phone', 'message', 'send_title', 'send_detail', 'content', 'u_id', 'created_time', 'updated_time'], 'safe'],
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
        $query = ApplyActivity::find()->orderBy('id desc');

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
            'supplier_id' => $this->supplier_id,
          
            'restrict' => $this->restrict,
            'willnum' => $this->willnum,
            'pv' => $this->pv,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'imgurl', $this->imgurl])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'mapmove', $this->mapmove])
            ->andFilterWhere(['like', 'merchant', $this->merchant])
            ->andFilterWhere(['like', 'initiator', $this->initiator])
            ->andFilterWhere(['like', 'phone', $this-> phone])
			->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'charge', $this->charge])
            ->andFilterWhere(['like', 'hedimg', $this-> hedimg])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'intro', $this-> intro])
            
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'send_title', $this->send_title])
            ->andFilterWhere(['like', 'send_detail', $this->send_detail])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'u_id', $this->u_id]);

        return $dataProvider;
    }
}
