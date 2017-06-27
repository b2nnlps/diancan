<?php

namespace backend\modules\merchant\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\merchant\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form about `backend\modules\merchant\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'rank', 'pv', 'open', 'status'], 'integer'],
            [['rh_openid', 'name', 'website', 'ad_img', 'labels', 'logo', 'phone', 'address', 'map', 'open_hours', 'open_scope', 'notice', 'message',  'brief','content', 'created_by', 'updated_by', 'created_time', 'updated_time'], 'safe'],
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
        $query = Supplier::find();

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
            'pv' => $this->pv,
            'open' => $this->open,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'rh_openid', $this->rh_openid])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'ad_img', $this->ad_img])
            ->andFilterWhere(['like', 'labels', $this->labels])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'map', $this->map])
            ->andFilterWhere(['like', 'open_hours', $this->open_hours])
            ->andFilterWhere(['like', 'open_scope', $this->open_scope])
            ->andFilterWhere(['like', 'notice', $this->notice])
            ->andFilterWhere(['like', 'message', $this->message])
           ->andFilterWhere(['like', 'brief', $this->brief])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
