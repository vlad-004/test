<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AppleStorage;

/**
 * AppleStorageSearch represents the model behind the search form of `backend\models\AppleStorage`.
 */
class AppleStorageSearch extends AppleStorage
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'state'], 'integer'],
            [['color', 'created_at', 'fell_at'], 'safe'],
            [['capacity'], 'number'],
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
        $query = AppleStorage::find();

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
            'state' => $this->state,
            'capacity' => $this->capacity,
            'created_at' => $this->created_at,
            'fell_at' => $this->fell_at,
        ]);

        $query->andFilterWhere(['like', 'color', $this->color]);

        return $dataProvider;
    }
}
