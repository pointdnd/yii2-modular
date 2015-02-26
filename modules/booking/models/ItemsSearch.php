<?php

namespace app\modules\booking\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\booking\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `app\modules\booking\models\Items`.
 */
class ItemsSearch extends Items
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at'], 'integer'],
            [['name', 'description', 'image', 'map_address'], 'safe'],
            [['map_address_lat', 'map_address_lng'], 'number'],
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
        $query = Items::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'map_address_lat' => $this->map_address_lat,
            'map_address_lng' => $this->map_address_lng,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'map_address', $this->map_address]);

        return $dataProvider;
    }
}
