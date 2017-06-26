<?php

namespace member\modules\member\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\member\models\MemberBind;

/**
 * MemberBindSearch represents the model behind the search form about `member\modules\member\models\MemberBind`.
 */
class MemberBindSearch extends MemberBind
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'card_id', 'type'], 'integer'],
            [['openid', 'phone', 'realname', 'begin_time', 'end_time', 'created_time'], 'safe'],
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
        $query = MemberBind::find();

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
            'card_id' => $this->card_id,
            'type' => $this->type,
            'begin_time' => $this->begin_time,
            'end_time' => $this->end_time,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'realname', $this->realname]);

        return $dataProvider;
    }
}
