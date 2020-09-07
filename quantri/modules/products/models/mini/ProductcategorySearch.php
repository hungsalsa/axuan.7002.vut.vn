<?php

namespace quantri\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\products\models\Productcategory;

/**
 * ProductcategorySearch represents the model behind the search form of `quantri\modules\quantri\models\Productcategory`.
 */
class ProductcategorySearch extends Productcategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCate', 'order', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['title', 'cateName', 'slug', 'keyword', 'description', 'content', 'short_introduction', 'home_page', 'image', 'active','product_parent_id'], 'safe'],
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
        $query = Productcategory::find()->alias('ca');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at' => SORT_DESC,'cateName'=>SORT_ASC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith("parent pa");
        // grid filtering conditions
        $query->andFilterWhere([
            'idCate' => $this->idCate,
            'order' => $this->order,
            // 'product_parent_id' => $this->product_parent_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'ca.title', $this->title])
            ->andFilterWhere(['like', 'ca.cateName', $this->cateName])
            ->andFilterWhere(['like', 'ca.slug', $this->slug])
            ->andFilterWhere(['like', 'ca.keyword', $this->keyword])
            ->andFilterWhere(['like', 'ca.description', $this->description])
            ->andFilterWhere(['like', 'ca.content', $this->content])
            ->andFilterWhere(['like', 'ca.short_introduction', $this->short_introduction])
            ->andFilterWhere(['like', 'pa.cateName', $this->product_parent_id])
            ->andFilterWhere(['like', 'ca.home_page', $this->home_page])
            ->andFilterWhere(['like', 'ca.image', $this->image])
            ->andFilterWhere(['like', 'ca.active', $this->active]);

        return $dataProvider;
    }
}
