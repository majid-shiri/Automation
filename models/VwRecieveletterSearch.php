<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VwRecieveletter;
use yii\web\NotFoundHttpException;

/**
 * VwRecieveletterSearch represents the model behind the search form of `app\models\VwRecieveletter`.
 */
class VwRecieveletterSearch extends VwRecieveletter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['let_Id', 'let_Date', 'let_Type', 'let_ActionType', 'let_SecurityType', 'let_State', 'let_Referral', 'let_ReplayType', 'let_FollowUpType', 'let_AttachType', 'let_CopiesType', 'let_ParaffType', 'let_ArchiveType', 'let_ResDateType', 'let_ResDate', 'let_Create_at', 'let_Edit_at', 'let_us_FK', 'ref_Id', 'ref_us_FK', 'ref_sender_FK', 'ref_readstate', 'ref_date'], 'integer'],
            [['let_Subject', 'let_Abstract', 'let_Text', 'let_Recipient', 'let_Sender', 'let_NumberIn', 'let_NumberSys', 'FullNameSender', 'FullNameReciever'], 'safe'],
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
        $session = \Yii::$app->session;

        $us_id = $session->get('us_id');

        if($us_id)
        {
        $query = VwRecieveletter::find()->where(['ref_us_FK'=>$us_id])->andWhere(['let_State'=>1])->orderBy([
            'ref_date' => SORT_DESC //specify sort order ASC for ascending DESC for descending
        ]);
        }
        else
        {
            throw  new  NotFoundHttpException('LettersSearch');
        }
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
            'let_Id' => $this->let_Id,
            'let_Date' => $this->let_Date,
            'let_Type' => $this->let_Type,
            'let_ActionType' => $this->let_ActionType,
            'let_SecurityType' => $this->let_SecurityType,
            'let_State' => $this->let_State,
            'let_refconf'=>$this->let_refconf,
            'let_refconf_state'=>$this->let_refconf_state,
            'let_Referral' => $this->let_Referral,
            'let_ReplayType' => $this->let_ReplayType,
            'let_FollowUpType' => $this->let_FollowUpType,
            'let_AttachType' => $this->let_AttachType,
            'let_CopiesType' => $this->let_CopiesType,
            'let_ParaffType' => $this->let_ParaffType,
            'let_ArchiveType' => $this->let_ArchiveType,
            'let_ResDateType' => $this->let_ResDateType,
            'let_ResDate' => $this->let_ResDate,
            'let_Create_at' => $this->let_Create_at,
            'let_Edit_at' => $this->let_Edit_at,
            'let_us_FK' => $this->let_us_FK,
            'ref_Id' => $this->ref_Id,
            'ref_us_FK' => $this->ref_us_FK,
            'ref_sender_FK' => $this->ref_sender_FK,
            'ref_readstate' => $this->ref_readstate,
            'ref_date' => $this->ref_date,
        ]);

        $query->andFilterWhere(['like', 'let_Subject', $this->let_Subject])
            ->andFilterWhere(['like', 'let_Abstract', $this->let_Abstract])
            ->andFilterWhere(['like', 'let_Text', $this->let_Text])
            ->andFilterWhere(['like', 'let_Recipient', $this->let_Recipient])
            ->andFilterWhere(['like', 'let_Sender', $this->let_Sender])
            ->andFilterWhere(['like', 'let_NumberIn', $this->let_NumberIn])
            ->andFilterWhere(['like', 'let_NumberSys', $this->let_NumberSys])
            ->andFilterWhere(['like', 'FullNameSender', $this->FullNameSender])
            ->andFilterWhere(['like', 'FullNameReciever', $this->FullNameReciever]);
        return $dataProvider;
    }
}
