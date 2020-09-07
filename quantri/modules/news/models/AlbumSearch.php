<?php

namespace quantri\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\news\models\Album;

/**
 * AlbumSearch represents the model behind the search form of `quantri\modules\news\models\Album`.
 */
class AlbumSearch extends Album
{
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'userCreated','view'], 'integer'],
            [['name', 'slug', 'cate_id', 'content', 'title', 'keywords', 'descriptions', 'userUpdated','short_description'], 'safe'],
            [['sort'], 'number'],
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
        $query = Album::find()->alias('a');
        $query->joinWith(['categories c','userUpdate up']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'sort' => SORT_DESC,
                'created_at' => SORT_DESC,
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
            'status' => $this->status,
            'sort' => $this->sort,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            // 'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'c.cateName', $this->cate_id])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'up.username', $this->userUpdated])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions]);

        return $dataProvider;
    }
}
