<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\ActivityPlayerModel;

/**
 * ActivityPlayerSearch represents the model behind the search form about `common\models\c2\entity\ActivityPlayerModel`.
 */
class ActivityPlayerSearch extends ActivityPlayerModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'user_id', 'free_vote_number', 'gift_vote_number', 'total_vote_number', 'share_number', 'view_number'], 'integer'],
            [['income'], 'number'],
            [['player_code', 'title', 'label', 'content', 'mobile_number', 'state', 'status', 'created_at', 'updated_at'], 'safe'],
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
        $query = ActivityPlayerModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'sortParam' => $this->getSortParamName(),
            ],
            'pagination' => [
                'pageParam' => $this->getPageParamName(),
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'income' => $this->income,
            'free_vote_number' => $this->free_vote_number,
            'gift_vote_number' => $this->gift_vote_number,
            'total_vote_number' => $this->total_vote_number,
            'share_number' => $this->share_number,
            'view_number' => $this->view_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'player_code', $this->player_code])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'mobile_number', $this->mobile_number])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "ActivityPlayerModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "ActivityPlayerModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
