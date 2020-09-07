<?php

namespace quantri\modules\news\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\news\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form of `quantri\modules\quantri\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'groupId', 'sort'], 'integer'],
            [['cateName', 'slug', 'parent_id', 'images', 'title', 'keyword', 'descriptions', 'status', 'created_at', 'updated_at','userUpdated','userCreated'], 'safe'],
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
        $query = Categories::find()->alias('c');
        $query->joinWith(['userUpdate up','parentCate p']);

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
        $query->orderBy([
            'c.updated_at' => SORT_DESC,
            'c.cateName' => SORT_ASC,
            'c.sort' => SORT_ASC, 
            // 'm.parent_id' => SORT_ASC, 
            // 'm.order' => SORT_ASC, 
        ]);

        // grid filtering conditions
        $query->andFilterWhere([
            'c.id' => $this->id,
            'groupId' => $this->groupId,
            // 'parent_id' => $this->parent_id,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            // 'userCreated' => $this->userCreated,
        ]);

        $query->andFilterWhere(['like', 'cateName', $this->cateName])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'p.cateName', $this->parent_id])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions])
            ->andFilterWhere(['like', 'up.username', $this->userUpdated])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
