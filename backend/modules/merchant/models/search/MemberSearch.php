<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Member;

/**
 * MemberSearch represents the model behind the search form about `backend\modules\merchant\models\Member`.
 */
class MemberSearch extends Member
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rank', 'sex','province', 'city', 'district', 'status'], 'integer'],
            [['rh_openid', 'uid', 'wx_openid', 'realname', 'phone', 'hobby','referrer', 'ticket', 'ticket_url', 'headimg', 'nickname', 'sdasd', 'address', 'remark', 'operator', 'created_time', 'updated_time'], 'safe'],
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
        $query = Member::find();

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
            'rank' => $this->rank,
            'sex' => $this->sex,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'uid', $this->uid])
            ->andFilterWhere(['like', 'wx_openid', $this->wx_openid])
            ->andFilterWhere(['like', 'realname', $this->realname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'referrer', $this->referrer])
            ->andFilterWhere(['like', 'ticket', $this->ticket])
            ->andFilterWhere(['like', 'ticket_url', $this->ticket_url])
            ->andFilterWhere(['like', 'headimg', $this->headimg])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'sdasd', $this->sdasd])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'operator', $this->operator]);

        return $dataProvider;
    }
}
