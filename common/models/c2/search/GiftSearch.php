<?php

namespace common\models\c2\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c2\entity\GiftModel;

/**
 * GiftSearch represents the model behind the search form about `common\models\c2\entity\GiftModel`.
 */
class GiftSearch extends GiftModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'activity_id', 'obtain_vote_number'], 'integer'],
            [['name', 'label', 'code', 'position', 'status', 'created_at', 'updated_at'], 'safe'],
            [['obtain_score', 'price'], 'number'],
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
        $query = GiftModel::find();

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
            'name' => $this->name,
            'activity_id' => $this->activity_id,
            'obtain_score' => $this->obtain_score,
            'obtain_vote_number' => $this->obtain_vote_number,
            'price' => $this->price,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

    public function getPageParamName($splitor = '-')
    {
        $name = "GiftModelPage";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }

    public function getSortParamName($splitor = '-')
    {
        $name = "GiftModelSort";
        return \Yii::$app->czaHelper->naming->toSplit($name);
    }
}
