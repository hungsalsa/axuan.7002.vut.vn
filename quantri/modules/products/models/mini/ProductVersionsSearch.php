<?php

namespace quantri\modules\products\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\products\models\ProductVersions;

/**
 * ProductVersionsSearch represents the model behind the search form of `quantri\modules\products\models\ProductVersions`.
 */
class ProductVersionsSearch extends ProductVersions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pro_id', 'status'], 'integer'],
            [['name','date'], 'safe'],
            [['price', 'price_sale'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = ProductVersions::find();

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
            'pro_id' => $this->pro_id,
            'price' => $this->price,
            'price_sale' => $this->price_sale,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
