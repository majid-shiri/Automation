<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Signature;

/**
 * SignatureSearch represents the model behind the search form of `app\models\Signature`.
 */
class SignatureSearch extends Signature
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sig_id', 'sig_us_id', 'sig_let_id', 'sig_state', 'sig_date'], 'integer'],
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
        $query = Signature::find();

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
            'sig_id' => $this->sig_id,
            'sig_us_id' => $this->sig_us_id,
            'sig_let_id' => $this->sig_let_id,
            'sig_state' => $this->sig_state,
            'sig_date' => $this->sig_date,
        ]);

        return $dataProvider;
    }
}
