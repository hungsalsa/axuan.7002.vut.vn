<?php

namespace quantri\modules\products\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\products\models\ProductsType;

/**
 * ProductsTypeSearch represents the model behind the search form of `quantri\modules\products\models\ProductsType`.
 */
class ProductsTypeSearch extends ProductsType
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code_type', 'status'], 'integer'],
            [['typeName'], 'safe'],
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
        $query = ProductsType::find();

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
            'code_type' => $this->code_type,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'typeName', $this->typeName]);

        return $dataProvider;
    }
}
