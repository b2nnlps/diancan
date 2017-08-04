<?php

namespace member\modules\food\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\food\models\FoodInfo;

/**
 * FoodInfoSearch represents the model behind the search form about `member\modules\food\models\FoodInfo`.
 */
class FoodInfoSearch extends FoodInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'food_id'], 'integer'],
            [['title'], 'safe'],
            [['price'], 'number'],
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
            $query = FoodInfo::find();
        } else {
            $query = FoodInfo::find()->where(['shop_id' => $shopId]);
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
            'price' => $this->price,
            'food_id' => $this->food_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
