<?php

namespace member\modules\food\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\food\models\Food;

/**
 * FoodSearch represents the model behind the search form about `member\modules\food\models\Food`.
 */
class FoodSearch extends Food
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'status', 'class_id'], 'integer'],
            [['name', 'img', 'created_time', 'updated_time'], 'safe'],
            //   [['price'], 'number'],
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
    public function search($params,$shop_id=0)
    {
        $shopId = Yii::$app->user->identity->shop_id;//获取当前登录用户的商家ID
        $role = Yii::$app->user->identity->role;//获取当前登录用户的权限ID
        if ($role < 3) {//如果为系统管理员则显示全部信息，否则只显示当前商家信息
            $query = Food::find()->orderBy('id desc');
        } else {
            $query = Food::find()->where(['shop_id' => $shopId])->orderBy('id desc');
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
//        if(!$shop_id) $shop_id=$this->shop_id;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'price' => $this->price,
            'shop_id' => $this->shop_id,
            'class_id' => $this->class_id,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
