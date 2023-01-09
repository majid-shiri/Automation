<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Roles;

/**
 * RolseSearch represents the model behind the search form of `app\models\Roles`.
 */
class RolseSearch extends Roles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rol_id'], 'integer'],
            [['rol_name', 'rol_description'], 'safe'],
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
        $query = Roles::find();

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
            'rol_id' => $this->rol_id,
        ]);

        $query->andFilterWhere(['like', 'rol_name', $this->rol_name])
            ->andFilterWhere(['like', 'rol_description', $this->rol_description]);

        return $dataProvider;
    }
}
