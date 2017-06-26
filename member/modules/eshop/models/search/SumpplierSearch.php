<?php

namespace member\modules\eshop\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use member\modules\eshop\models\Sumpplier;

/**
 * SumpplierSearch represents the model behind the search form about `member\modules\eshop\models\Sumpplier`.
 */
class SumpplierSearch extends Sumpplier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'open', 'status', 'views'], 'integer'],
            [['openid', 'user_id', 'name','ad_img', 'website', 'labels', 'logo', 'phone', 'address', 'open_hours', 'open_scope', 'notice', 'message', 'content', 'created_by', 'updated_by', 'created_time', 'updated_time'], 'safe'],
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
        $query = Sumpplier::find()->orderBy('id desc');

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
            'open' => $this->open,
            'status' => $this->status,
            'views' => $this->views,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'openid', $this->openid])
            ->andFilterWhere(['like', 'user_id', $this->user_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'ad_img', $this->ad_img])
            ->andFilterWhere(['like', 'labels', $this->labels])
            ->andFilterWhere(['like', 'open_hours', $this->open_hours])
            ->andFilterWhere(['like', 'open_scope', $this->open_scope])
            ->andFilterWhere(['like', 'notice', $this->notice])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
