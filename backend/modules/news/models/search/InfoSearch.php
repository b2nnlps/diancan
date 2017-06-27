<?php

namespace backend\modules\news\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\news\models\NewsInfo;

/**
 * InfoSearch represents the model behind the search form about `backend\modules\news\models\NewsInfo`.
 */
class InfoSearch extends NewsInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'cid', 'carousel', 'hret_status', 'pv', 'praise', 'collect', 'transpond', 'status'], 'integer'],
            [['title', 'intro', 'img', 'source', 'source_url', 'editor', 'hret_url', 'content', 'uid', 'created_time', 'updated_time'], 'safe'],
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
        $query = NewsInfo::find()->orderBy('id desc');

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
            'cid' => $this->cid,
            'carousel' => $this->carousel,
            'hret_status' => $this->hret_status,
            'pv' => $this->pv,
            'praise' => $this->praise,
            'collect' => $this->collect,
            'transpond' => $this->transpond,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'source_url', $this->source_url])
            ->andFilterWhere(['like', 'editor', $this->editor])
            ->andFilterWhere(['like', 'hret_url', $this->hret_url])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'uid', $this->uid]);

        return $dataProvider;
    }
}
