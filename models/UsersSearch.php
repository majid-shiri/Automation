<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['us_id', 'us_apsnelcode', 'us_gender', 'us_online', 'us_status', 'us_mobile', 'us_phone', 'us_role', 'us_created_at', 'us_updated_at'], 'integer'],
            [['us_username', 'us_password', 'us_fname', 'us_lname', 'us_nickname', 'us_email', 'us_pic','us_sign'], 'safe'],
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
        $query = Users::find();

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
            'us_id' => $this->us_id,
            'us_apsnelcode' => $this->us_apsnelcode,
            'us_gender' => $this->us_gender,
            'us_online' => $this->us_online,
            'us_status' => $this->us_status,
            'us_mobile' => $this->us_mobile,
            'us_phone' => $this->us_phone,
            'us_role' => $this->us_role,
            'us_created_at' => $this->us_created_at,
            'us_updated_at' => $this->us_updated_at,
        ]);

        $query->andFilterWhere(['like', 'us_username', $this->us_username])
            ->andFilterWhere(['like', 'us_password', $this->us_password])
            ->andFilterWhere(['like', 'us_fname', $this->us_fname])
            ->andFilterWhere(['like', 'us_lname', $this->us_lname])
            ->andFilterWhere(['like', 'us_nickname', $this->us_nickname])
            ->andFilterWhere(['like', 'us_email', $this->us_email])
            ->andFilterWhere(['like', 'us_pic', $this->us_pic])
            ->andFilterWhere(['like', 'us_sign', $this->us_sign]);

        return $dataProvider;
    }
}
