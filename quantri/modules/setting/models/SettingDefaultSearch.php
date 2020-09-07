<?php

namespace quantri\modules\setting\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\SettingDefault;

/**
 * SettingDefaultSearch represents the model behind the search form of `quantri\modules\setting\models\SettingDefault`.
 */
class SettingDefaultSearch extends SettingDefault
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'talk_do'], 'integer'],
            [['logo', 'title', 'description', 'keyword', 'ad', 'footer_left', 'footer_right', 'google_analytics', 'layout_frontent', 'layout_backend'], 'safe'],
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
        $query = SettingDefault::find();

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
            'talk_do' => $this->talk_do,
        ]);

        $query->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'ad', $this->ad])
            ->andFilterWhere(['like', 'footer_left', $this->footer_left])
            ->andFilterWhere(['like', 'footer_right', $this->footer_right])
            ->andFilterWhere(['like', 'layout_frontent', $this->layout_frontent])
            ->andFilterWhere(['like', 'layout_backend', $this->layout_backend])
            ->andFilterWhere(['like', 'google_analytics', $this->google_analytics]);

        return $dataProvider;
    }
}
