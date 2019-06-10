<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\ActivityModel;

/**
 * ActivitySearch represents the model behind the search form about `common\models\c2\entity\ActivityModel`.
 */
class ActivitySearch extends ActivityModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'area_limit', 'vote_number', 'view_number', 'share_number', 'start_id', 'created_by', 'updated_by'], 'integer'],
            [['type', 'title', 'label', 'content', 'seo_code', 'start_at', 'end_at',
                'vote_number_limit', 'is_open_draw', 'is_check', 'is_released', 'status',
                'created_at', 'updated_at'], 'safe'],
            [['income'], 'number'],
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
        $query = ActivityModel::find();

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
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'area_limit' => $this->area_limit,
            'vote_number' => $this->vote_number,
            'share_number' => $this->share_number,
            'income' => $this->income,
            'start_id' => $this->start_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'seo_code', $this->seo_code])
            ->andFilterWhere(['like', 'vote_number_limit', $this->vote_number_limit])
            ->andFilterWhere(['like', 'is_open_draw', $this->is_open_draw])
            ->andFilterWhere(['like', 'is_check', $this->is_check])
            ->andFilterWhere(['like', 'is_released', $this->is_released])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
    
    public function getPageParamName($splitor = '-'){
        $name = "ActivityModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
    
    public function getSortParamName($splitor = '-'){
        $name = "ActivityModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
