<?php

namespace member\modules\sys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\sys\models\Loginlog;

/**
 * LoginlogSearch represents the model behind the search form about `member\modules\sys\models\Loginlog`.
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
        $userId = Yii::$app->user->id;//获取当前登录用户的ID
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果为系统管理员则显示全部信息，否则只显示当前商家信息
            $query = Loginlog::find()->orderBy('id desc');
        } else {
            $query = Loginlog::find()->where(['u_id' => $userId]);
        }


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
