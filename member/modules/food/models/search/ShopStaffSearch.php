<?php

namespace member\modules\food\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\food\models\ShopStaff;

/**
 * ShopStaffSearch represents the model behind the search form about `member\modules\food\models\ShopStaff`.
 */
class ShopStaffSearch extends ShopStaff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'role_id', 'status'], 'integer'],
            [['phone', 'openid', 'username', 'password', 'realname', 'created_time'], 'safe'],
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
        $shop_id = Yii::$app->user->identity->shop_id;
        $role = Yii::$app->user->identity->role;
        if ($role == 2) {
            $query = ShopStaff::find()->orderBy('id desc');
        } else {
            $query = ShopStaff::find()->where(['shop_id' => $shop_id])->orderBy('id desc');
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
            'shop_id' => $this->shop_id,
            'role_id' => $this->role_id,
            'status' => $this->status,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'realname', $this->realname]);

        return $dataProvider;
    }
}
