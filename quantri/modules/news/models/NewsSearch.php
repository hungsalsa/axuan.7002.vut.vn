<?php

namespace quantri\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\news\models\News;

/**
 * NewsSearch represents the model behind the search form of `quantri\modules\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'hot', 'view', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'newSlug', 'images', 'image_category', 'image_detail', 'htmltitle', 'htmlkeyword', 'htmldescriptions', 'short_description', 'content', 'related_products', 'category_id', 'userCreated', 'userUpdated', 'related_news','tags','related_albums', 'related_downloads','formshow','interest'], 'safe'],
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
        $query = News::find()->alias('n');
        // add conditions that should always apply here
        $query->joinWith(['categories c','userUpdate up']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'sort' => SORT_DESC,
                'updated_at' => SORT_DESC,
                // 'n.pro_name' => SORT_ASC,
            ]
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
            // 'category_id' => $this->category_id,
            'hot' => $this->hot,
            'view' => $this->view,
            'sort' => $this->sort,
            'status' => $this->status,
            'formshow' => $this->formshow,
            'userCreated' => $this->userCreated,
            // 'userUpdated' => $this->userUpdated,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'newSlug', $this->newSlug])
            ->andFilterWhere(['like', 'c.cateName', $this->category_id])
            ->andFilterWhere(['like', 'up.username', $this->userUpdated])
            ->andFilterWhere(['like', 'images', $this->images])
            ->andFilterWhere(['like', 'image_category', $this->image_category])
            ->andFilterWhere(['like', 'image_detail', $this->image_detail])
            ->andFilterWhere(['like', 'htmltitle', $this->htmltitle])
            ->andFilterWhere(['like', 'htmlkeyword', $this->htmlkeyword])
            ->andFilterWhere(['like', 'htmldescriptions', $this->htmldescriptions])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'related_products', $this->related_products])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'related_albums', $this->related_albums])
            ->andFilterWhere(['like', 'related_downloads', $this->related_downloads])
            ->andFilterWhere(['like', 'related_news', $this->related_news]);

        return $dataProvider;
    }
}
