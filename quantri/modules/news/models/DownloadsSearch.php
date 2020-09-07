<?php

namespace quantri\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\news\models\Downloads;

/**
 * DownloadsSearch represents the model behind the search form of `quantri\modules\news\models\Downloads`.
 */
class DownloadsSearch extends Downloads
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'link', 'category_slug', 'descriptions','cate_id', 'userCreated', 'userUpdated'], 'safe'],
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
        $query = Downloads::find()->alias('d');

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
            'sort' => $this->sort,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            // 'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'c.cateName', $this->cate_id])
            ->andFilterWhere(['like', 'up.username', $this->userUpdated])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions]);

        return $dataProvider;
    }
}
