<?php

namespace quantri\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\SettingTabs;

/**
 * SettingTabsSearch represents the model behind the search form of `quantri\modules\setting\models\SettingTabs`.
 */
class SettingTabsSearch extends SettingTabs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'link_cate', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['slug', 'name', 'status','title','child_cate'], 'safe'],
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
        $query = SettingTabs::find();

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
            'link_cate' => $this->link_cate,
            'child_cate' => $this->child_cate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
