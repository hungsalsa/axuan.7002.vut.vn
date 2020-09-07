<?php

namespace quantri\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\SettingCategory;

/**
 * SettingCategorySearch represents the model behind the search form of `quantri\modules\setting\models\SettingCategory`.
 */
class SettingCategorySearch extends SettingCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order', 'created_at', 'updated_at', 'user_add'], 'integer'],
            [['name', 'slug', 'title', 'description', 'icon', 'link_cate', 'parent_id', 'status'], 'safe'],
            [['name', 'slug'], 'trim'],
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
        $query = SettingCategory::find();

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

        $query->joinWith('productCategory cate');
        $query->joinWith('parent pa');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            // 'parent_id' => $this->parent_id,
            // 'link_cate' => $this->link_cate,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_add' => $this->user_add,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'cate.cateName', $this->link_cate])
            ->andFilterWhere(['like', 'pa.name', $this->parent_id]);

        return $dataProvider;
    }
}
