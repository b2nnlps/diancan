<?php

namespace backend\modules\sys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\sys\models\Loginlog;

/**
 * LoginlogSearch represents the model behind the search form about `backend\modules\sys\models\Loginlog`.
 */
class LoginlogSearch extends Loginlog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'login_time'], 'integer'],
            [['u_id', 'login_address', 'login_ip', 'login_equipment'], 'safe'],
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
        $query = Loginlog::find()->orderBy('id desc');

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
            'login_time' => $this->login_time,
        ]);

        $query->andFilterWhere(['like', 'u_id', $this->u_id])
            ->andFilterWhere(['like', 'login_address', $this->login_address])
            ->andFilterWhere(['like', 'login_ip', $this->login_ip])
            ->andFilterWhere(['like', 'login_equipment', $this->login_equipment]);

        return $dataProvider;
    }
}
