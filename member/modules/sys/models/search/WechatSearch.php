<?php

namespace member\modules\sys\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\sys\models\WechatUser;

/**
 * WechatSearch represents the model behind the search form about `member\modules\sys\models\Wechat`.
 */
class WechatSearch extends WechatUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['openid', 'nickname', 'headimgurl', 'address', 'subscribe_time','updated_time', 'remark'], 'safe'],
            [['sex', 'subscribe', 'module', 'auth_time', 'status'], 'integer'],
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

        $query = WechatUser::find()->orderBy('updated_time desc');
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
            'sex' => $this->sex,
            'subscribe' => $this->subscribe,
            'subscribe_time' => $this->subscribe_time,
            'updated_time' => $this->updated_time,
            'module' => $this->module,
            'auth_time' => $this->auth_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'headimgurl', $this->headimgurl])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
