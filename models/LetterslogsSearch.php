<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Letterslogs;

/**
 * LetterslogsSearch represents the model behind the search form of `app\models\Letterslogs`.
 */
class LetterslogsSearch extends Letterslogs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['let_log_Id', 'let_log_Category', 'let_log_us_FK', 'let_log_let_FK', 'let_log_Date'], 'integer'],
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
        $query = Letterslogs::find();

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
            'let_log_Id' => $this->let_log_Id,
            'let_log_Category' => $this->let_log_Category,
            'let_log_us_FK' => $this->let_log_us_FK,
            'let_log_let_FK' => $this->let_log_let_FK,
            'let_log_Date' => $this->let_log_Date,
        ]);

        return $dataProvider;
    }
}
