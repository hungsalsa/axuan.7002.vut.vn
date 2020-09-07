<?php

namespace quantri\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\SettingCategories;

/**
 * SettingCategoriesSearch represents the model behind the search form of `quantri\modules\setting\models\SettingCategories`.
 */
class SettingCategoriesSearch extends SettingCategories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'userCreated','userUpdated'], 'integer'],
            [['name', 'slug_cate', 'title', 'description', 'icon', 'status'], 'safe'],
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
        $query = SettingCategories::find();

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
            'parent_id' => $this->parent_id,
            'link_cate' => $this->link_cate,
            'order' => $this->order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug_cate', $this->slug_cate])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
