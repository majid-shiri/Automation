<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Permits;

/**
 * PermitsSearch represents the model behind the search form of `app\models\Permits`.
 */
class PermitsSearch extends Permits
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['permit_id', 'permit_us_id', 'permit_10', 'permit_11', 'permit_12', 'permit_13', 'permit_14', 'permit_15', 'permit_16', 'permit_17', 'permit_20', 'permit_21', 'permit_22', 'permit_23', 'permit_24', 'permit_25', 'permit_30', 'permit_31', 'permit_32', 'permit_33', 'permit_40', 'permit_41', 'permit_42', 'permit_43', 'permit_44'], 'integer'],
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
        $query = Permits::find();

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
            'permit_id' => $this->permit_id,
            'permit_us_id' => $this->permit_us_id,
            'permit_10' => $this->permit_10,
            'permit_11' => $this->permit_11,
            'permit_12' => $this->permit_12,
            'permit_13' => $this->permit_13,
            'permit_14' => $this->permit_14,
            'permit_15' => $this->permit_15,
            'permit_16' => $this->permit_16,
            'permit_20' => $this->permit_20,
            'permit_21' => $this->permit_21,
            'permit_22' => $this->permit_22,
            'permit_23' => $this->permit_23,
            'permit_24' => $this->permit_24,
            'permit_25' => $this->permit_25,
            'permit_30' => $this->permit_30,
            'permit_31' => $this->permit_31,
            'permit_32' => $this->permit_32,
            'permit_33' => $this->permit_33,
            'permit_40' => $this->permit_40,
            'permit_41' => $this->permit_41,
            'permit_42' => $this->permit_42,
            'permit_43' => $this->permit_43,
            'permit_44' => $this->permit_44,
        ]);

        return $dataProvider;
    }
}
