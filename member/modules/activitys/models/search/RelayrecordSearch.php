<?php

namespace member\modules\activitys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\activitys\models\RelayRecord;

/**
 * RelayrecordSearch represents the model behind the search form about `member\modules\activitys\models\RelayRecord`.
 */
class RelayrecordSearch extends RelayRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'point',], 'integer'],
            [['from_user', 'to_user', 'date'], 'safe'],
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
        $query = RelayRecord::find()->orderBy('id desc');

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
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'from_user', $this->from_user])
            ->andFilterWhere(['like', 'to_user', $this->to_user]);

        return $dataProvider;
    }
}
