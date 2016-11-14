<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Enquiry;

/**
 * EnquirySearch represents the model behind the search form about `app\models\Enquiry`.
 */
class EnquirySearch extends Enquiry
{
    /**
     * @inheritdoc
     */
    public $nameAndEmail;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['on_date', 'name', 'email', 'gender','nameAndEmail','status'], 'safe'],
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
        $query = Enquiry::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
       
        'attributes'=>[
       'id',
            'on_date',
            'nameAndEmail'=>[
                'asc'=>['name'=>SORT_ASC, 'email'=>SORT_ASC],
                'desc'=>['name'=>SORT_DESC, 'email'=>SORT_DESC],
                'label'=>'Name And Email',
                'default'=>SORT_ASC
            ],
            'gender',
            'status'
            
        ]
    ]);

        //print_r($params);exit;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status'=>  $this->status,
            'gender'=>  $this->gender,
        ]);
        //echo $this->on_date; list($start_date, $end_date) = explode(' - ', $this->on_date);
       // echo $end_date. " ".$start_date;
       // exit;
        
        if(!empty($this->on_date) ) { 
            //echo 'in if';
            list($start_date, $end_date) = explode(' - ', $this->on_date);
        $query->andFilterWhere(['between', 'on_date', $start_date, $end_date]); 
        
        }
        $query->andFilterWhere(['like', 'name', $this->nameAndEmail])
                 ->orFilterWhere(['like', 'email', $this->nameAndEmail]);

        return $dataProvider;
    }
    
    
}
