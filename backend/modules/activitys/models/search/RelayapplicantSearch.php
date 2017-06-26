<?php

namespace backend\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\activitys\models\RelayApplicant;

/**
 * RelayapplicantSearch represents the model behind the search form about `backend\modules\activitys\models\RelayApplicant`.
 */
class RelayapplicantSearch extends RelayApplicant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'point', 'status'], 'integer'],
            [['wechat_id', 'name', 'mobilephone', 'datetime', 'declaration', 'imgurl'], 'safe'],
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
        $query = RelayApplicant::find()->orderBy('id desc');

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
            'activity_id' => $this->activity_id,
            'point' => $this->point,
            'datetime' => $this->datetime,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'wechat_id', $this->wechat_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'mobilephone', $this->mobilephone])
            ->andFilterWhere(['like', 'declaration', $this->declaration])
            ->andFilterWhere(['like', 'imgurl', $this->imgurl]);

        return $dataProvider;
    }
}
