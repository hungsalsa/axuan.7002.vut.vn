<?php

namespace quantri\modules\setting\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\SettingModules;

/**
 * SettingModulesSearch represents the model behind the search form of `quantri\modules\setting\models\SettingModules`.
 */
class SettingModulesSearch extends SettingModules
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cate_slug', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated','parent_id'], 'integer'],
            [['name', 'type_module', 'positions', 'page_show', 'content','hienthi','cate_id'], 'safe'],
            [['order'], 'number'],
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
        $query = SettingModules::find();

        // add conditions that should always apply here
        // $query->where('parent_id=:parent_id', [':parent_id' => 0]);
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
            // 'cate_slug' => $this->cate_slug,
            'order' => $this->order,
            'status' => $this->status,
            'hienthi' => $this->hienthi,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type_module', $this->type_module])
            ->andFilterWhere(['like', 'cate_id', $this->cate_id])
            ->andFilterWhere(['like', 'positions', $this->positions])
            ->andFilterWhere(['like', 'page_show', $this->page_show])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
