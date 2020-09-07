<?php

namespace quantri\modules\customer\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use quantri\modules\customer\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `quantri\modules\customer\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'status', 'created_at', 'updated_at', 'userCreated', 'userUpdated'], 'integer'],
            [['company_name', 'address', 'tax_code', 'manager', 'birth_day', 'phone', 'email', 'business', 'date_bussiness', 'website'], 'safe'],
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
        $query = Contacts::find();

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
            'gender' => $this->gender,
            'birth_day' => $this->birth_day,
            'date_bussiness' => $this->date_bussiness,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'userCreated' => $this->userCreated,
            'userUpdated' => $this->userUpdated,
        ]);

        $query->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'tax_code', $this->tax_code])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business', $this->business])
            ->andFilterWhere(['like', 'website', $this->website]);

        return $dataProvider;
    }
}
