<?php

namespace mii\modules\products\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use mii\modules\products\models\Lists;

/**
 * ListsSearch represents the model behind the search form about `mii\modules\products\models\Lists`.
 */
class ListsSearch extends Lists
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'products_packages_id', 'orden_id'], 'integer'],
            [['title', 'image', 'description'], 'safe'],
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
        $query = Lists::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'products_packages_id' => $this->products_packages_id,
            'orden_id' => $this->orden_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
