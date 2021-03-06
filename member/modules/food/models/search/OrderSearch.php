<?php

namespace member\modules\food\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\food\models\Order;

/**
 * OrderSearch represents the model behind the search form about `member\modules\food\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user', 'orderno', 'text', 'phone', 'realname', 'people', 'total', 'table', 'created_time', 'updated_time'], 'safe'],
            [['num', 'shop_id', 'total', 'status'], 'integer'],
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

        $shopId = Yii::$app->user->identity->shop_id;//获取当前登录用户的商家ID
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果为系统管理员则显示全部信息，否则只显示当前商家信息
            $query = Order::find()->orderBy('id desc');
        } else {
            $query = Order::find()->where(['shop_id' => $shopId])->orderBy('id desc');
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
            'num' => $this->num,
            'shop_id' => $this->shop_id,
            'status' => $this->status,
            'total' => $this->total,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,

        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'user', $this->user])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'realname', $this->realname])
            ->andFilterWhere(['like', 'table', $this->table])
            ->andFilterWhere(['like', 'people', $this->people])

            ->andFilterWhere(['like', 'orderno', $this->orderno])
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
