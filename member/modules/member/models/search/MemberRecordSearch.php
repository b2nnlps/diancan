<?php

namespace member\modules\member\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\member\models\MemberRecord;

/**
 * MemberRecordSearch represents the model behind the search form about `member\modules\member\models\MemberRecord`.
 */
class MemberRecordSearch extends MemberRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'staff_id', 'bind_id', 'type', 'cost'], 'integer'],
            [[ 'created_time'], 'safe'],
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
        $query = MemberRecord::find();

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
            'staff_id' => $this->staff_id,
            'bind_id' => $this->bind_id,
            'type' => $this->type,
            'cost' => $this->cost,
            'created_time' => $this->created_time,
        ]);

        return $dataProvider;
    }
}
