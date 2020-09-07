<?php

namespace quantri\modules\products\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\products\models\Order;

/**
 * OrderSearch represents the model behind the search form of `quantri\modules\products\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'delivery_date', 'status', 'created_at', 'updated_at', 'userUpdated'], 'integer'],
            [['user_ship', 'mobile_ship', 'customer_id'], 'safe'],
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
        $query = Order::find()->alias('o');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'updated_at' => SORT_DESC,
                'created_at' => SORT_DESC,
                'userUpdated' => SORT_DESC,
                'status' => SORT_DESC,
                // 'pro_name' => SORT_ASC,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith(['khachhang k']);

        // grid filtering conditions
        $query->andFilterWhere([
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'delivery_date' => $this->delivery_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userUpdated' => $this->userUpdated,
        ]);

        $query
            ->andFilterWhere(['like', 'k.fullname', $this->customer_id])
            ->andFilterWhere(['like', 'k.email', $this->customer_id])
            ->andFilterWhere(['like', 'k.phone', $this->customer_id])
            ->andFilterWhere(['like', 'k.address', $this->customer_id])
            ->andFilterWhere(['like', 'user_ship', $this->user_ship])
            ->andFilterWhere(['like', 'mobile_ship', $this->mobile_ship]);

        return $dataProvider;
    }
}
