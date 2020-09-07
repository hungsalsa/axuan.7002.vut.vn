<?php

namespace quantri\modules\setting\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\setting\models\Menus;

/**
 * MenusSearch represents the model behind the search form of `quantri\modules\setting\models\Menus`.
 */
class MenusSearch extends Menus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             [['id', 'type', 'parent_id', 'link_cate', 'order', 'created_at', 'updated_at', 'userCreated'], 'integer'],
            [['name', 'title', 'slug', 'introduction', 'image', 'status','parent_name'], 'safe'],
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
        $query = Menus::find()->alias('m');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => [
                'parent_name' => SORT_DESC,
                'name' => SORT_ASC,
                'status' => SORT_DESC,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // $query->andWhere(['m.parent_id' => 0]);
        
        $query->joinWith(['categoryPro c','parent p']);
        $query->orderBy([
            // 'm.type' => SORT_ASC,
            'p.parent_id' => SORT_ASC, 
            // 'm.parent_id' => SORT_ASC, 
            // 'm.order' => SORT_ASC, 
            // 'c.cateName' => SORT_ASC
        ]);

        /*$dataProvider->setSort([
            'defaultOrder' => [
                'name' => SORT_ASC,
                // 'm.name' => SORT_ASC,
                // 'p.name' => SORT_ASC,
            ]
        ]);*/
        // $query->joinWith(['xuatphat xp','dichden dd','tickettype ty','kichhoat k']);

        // grid filtering conditions
        $query->andFilterWhere([
            'm.id' => $this->id,
            'm.type' => $this->type,
            'm.parent_id' => $this->parent_id,
            'm.link_cate' => $this->link_cate,
            'm.order' => $this->order,
            'm.parent_name' => $this->parent_name,
            'm.created_at' => $this->created_at,
            'm.updated_at' => $this->updated_at,
            'm.userCreated' => $this->userCreated,
        ]);

        $query->andFilterWhere(['like', 'm.name', $this->name])
        ->andFilterWhere(['like', 'm.title', $this->title])
            ->andFilterWhere(['like', 'm.slug', $this->slug])
            ->andFilterWhere(['like', 'm.introduction', $this->introduction])
            ->andFilterWhere(['like', 'm.image', $this->image])
            ->andFilterWhere(['like', 'm.status', $this->status]);

        return $dataProvider;
    }
}
