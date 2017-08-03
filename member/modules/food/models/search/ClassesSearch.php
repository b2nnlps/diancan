<?php

namespace member\modules\food\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\food\models\Classes;

/**
 * ClassesSearch represents the model behind the search form about `member\modules\food\models\Classes`.
 */
class ClassesSearch extends Classes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id'], 'integer'],
            [['name', 'updated_time', 'created_time'], 'safe'],
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

        $shop_id = Yii::$app->user->identity->shop_id;
        $role = Yii::$app->user->identity->role;
        if ($role < 3) {
            $query = Classes::find();
        } else {
            $query = Classes::find()->where(['shop_id' => $shop_id]);
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
//        if(!$shop_id)$shop_id=$this->shop_id;
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'updated_time' => $this->updated_time,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
