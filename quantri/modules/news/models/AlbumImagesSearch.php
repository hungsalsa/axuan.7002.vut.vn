<?php

namespace quantri\modules\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\news\models\AlbumImages;

/**
 * AlbumImagesSearch represents the model behind the search form of `quantri\modules\news\models\AlbumImages`.
 */
class AlbumImagesSearch extends AlbumImages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'album_id'], 'integer'],
            [['image', 'title', 'descriptions'], 'safe'],
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
        $query = AlbumImages::find();

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
            'album_id' => $this->album_id,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'descriptions', $this->descriptions]);

        return $dataProvider;
    }
}
