<?php

namespace quantri\modules\products\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\products\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `quantri\modules\products\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inventory', 'amount', 'order_out_stock', 'price', 'price_sales', 'vat', 'product_type_id', 'supplier_id', 'warranty_period', 'models_id', 'views', 'status', 'time_status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['code', 'pro_name', 'title', 'slug', 'keywords', 'descriptions', 'short_introduction', 'content', 'start_sale', 'end_sale', 'image', 'images_list', 'tags', 'related_articles', 'related_products','highlights','product_category_id','tab2','tab3','hot','related_albums', 'related_downloads'], 'safe'],
            [['order'], 'number'],
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
        $query = Products::find()->alias('p');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'updated_at' => SORT_DESC,
                'order' => SORT_ASC,
                'pro_name' => SORT_ASC,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith(["productCategory ca"]);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'inventory' => $this->inventory,
            'amount' => $this->amount,
            'order_out_stock' => $this->order_out_stock,
            'price' => $this->price,
            'price_sales' => $this->price_sales,
            'vat' => $this->vat,
            'start_sale' => $this->start_sale,
            'end_sale' => $this->end_sale,
            'order' => $this->order,
            'highlights' => $this->highlights,
            'product_type_id' => $this->product_type_id,
            'supplier_id' => $this->supplier_id,
            'warranty_period' => $this->warranty_period,
            'models_id' => $this->models_id,
            'views' => $this->views,
            // 'product_category_id' => $this->product_category_id,
            'status' => $this->status,
            'time_status' => $this->time_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'pro_name', $this->pro_name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions])
            ->andFilterWhere(['like', 'short_introduction', $this->short_introduction])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tab2', $this->tab2])
            ->andFilterWhere(['like', 'tab3', $this->tab3])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'images_list', $this->images_list])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'ca.cateName', $this->product_category_id])
            ->andFilterWhere(['like', 'related_articles', $this->related_articles])
            ->andFilterWhere(['like', 'related_products', $this->related_products]);

        return $dataProvider;
    }
}